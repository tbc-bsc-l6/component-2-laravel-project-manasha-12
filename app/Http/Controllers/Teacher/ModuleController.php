<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    /**
     * Display a listing of teacher's assigned modules
     */
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();

        // Get teacher's assigned modules with enrollment counts
        $modules = $teacher->modules()
            ->withCount([
                'enrollments as total_students',
                'activeEnrollments as active_students',
                'enrollments as completed_students' => function ($query) {
                    $query->where('status', 'completed');
                },
                'enrollments as passed_students' => function ($query) {
                    $query->where('status', 'completed')->where('pass_status', 'pass');
                },
                'enrollments as failed_students' => function ($query) {
                    $query->where('status', 'completed')->where('pass_status', 'fail');
                }
            ])
            ->get();

        return view('teacher.modules.index', compact('modules'));
    }

    /**
     * Display the specified module with enrolled students
     */
    public function show(Module $module)
    {
        $teacher = Auth::guard('teacher')->user();

        // Check if teacher is assigned to this module
        if (!$teacher->teachesModule($module)) {
            abort(403, 'You are not assigned to this module.');
        }

        // ✅ FIX: Load enrollments and filter out those without students
        $module->load([
            'activeEnrollments.student',
            'enrollments' => function ($query) {
                $query->where('status', 'completed')->with('student');
            }
        ]);

        // ✅ FIX: Filter out enrollments where student is null (deleted students)
        $activeEnrollments = $module->activeEnrollments->filter(function ($enrollment) {
            return $enrollment->student !== null;
        });

        $completedEnrollments = $module->enrollments
            ->where('status', 'completed')
            ->filter(function ($enrollment) {
                return $enrollment->student !== null;
            });

        // Statistics
        $stats = [
            'total_students' => $module->enrollments()->whereHas('student')->count(),
            'active_students' => $activeEnrollments->count(),
            'completed_students' => $completedEnrollments->count(),
            'passed_students' => $completedEnrollments->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'PASS';
            })->count(),
            'failed_students' => $completedEnrollments->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'FAIL';
            })->count(),
        ];

        // Calculate pass rate
        $stats['pass_rate'] = $completedEnrollments->count() > 0 
            ? round(($stats['passed_students'] / $completedEnrollments->count()) * 100, 1)
            : 0;

        return view('teacher.modules.show', compact('module', 'activeEnrollments', 'completedEnrollments', 'stats'));
    }

    /**
     * Grade a single student (PASS or FAIL)
     */
    public function gradeStudent(Request $request, Module $module, Enrollment $enrollment)
    {
        $teacher = Auth::guard('teacher')->user();

        // Verify teacher is assigned to this module
        if (!$teacher->teachesModule($module)) {
            abort(403, 'You are not assigned to this module.');
        }

        // Verify enrollment belongs to this module
        if ($enrollment->module_id !== $module->id) {
            abort(404, 'Enrollment not found for this module.');
        }

        // ✅ FIX: Check if student exists
        if (!$enrollment->student) {
            return back()->with('error', 'Student not found. They may have been removed from the system.');
        }

        // ✅ FIX: Verify enrollment is active BEFORE doing anything else
        if ($enrollment->status !== 'active') {
            $currentGrade = strtoupper($enrollment->pass_status ?? 'N/A');
            return back()->with('error', "This student has already been graded as {$currentGrade}.");
        }

        // Validate grade
        $validated = $request->validate([
            'pass_status' => ['required', 'in:PASS,FAIL'],
        ]);

        // Get the pass status from validated data
        $passStatus = $validated['pass_status'];
        $student = $enrollment->student;

        // Log before update
        Log::info('Grading student BEFORE', [
            'enrollment_id' => $enrollment->id,
            'student' => $student->name,
            'requested_grade' => $passStatus,
            'current_status' => $enrollment->status,
            'current_pass_status' => $enrollment->pass_status,
        ]);

        // ✅ Update enrollment with explicit values
        $enrollment->status = 'completed';
        $enrollment->completed_at = now();
        $enrollment->pass_status = $passStatus;
        
        try {
            $enrollment->save();
        } catch (\Illuminate\Database\QueryException $e) {
            // ✅ Handle unique constraint violation
            if ($e->getCode() === '23000') {
                Log::error('Duplicate enrollment grading attempt', [
                    'enrollment_id' => $enrollment->id,
                    'student_id' => $enrollment->student_id,
                    'module_id' => $enrollment->module_id,
                    'error' => $e->getMessage()
                ]);
                return back()->with('error', 'This student has already been graded. Please refresh the page.');
            }
            throw $e;
        }

        // Refresh from database to confirm
        $enrollment->refresh();

        // Log after update
        Log::info('Grading student AFTER', [
            'enrollment_id' => $enrollment->id,
            'saved_status' => $enrollment->status,
            'saved_pass_status' => $enrollment->pass_status,
            'saved_completed_at' => $enrollment->completed_at,
        ]);

        return back()->with('success', "Successfully marked {$student->name} as {$passStatus}.");
    }

    /**
     * Bulk grade multiple students at once
     */
    public function bulkGrade(Request $request, Module $module)
    {
        $teacher = Auth::guard('teacher')->user();

        // Verify teacher is assigned to this module
        if (!$teacher->teachesModule($module)) {
            abort(403, 'You are not assigned to this module.');
        }

        // Validate input
        $request->validate([
            'enrollments' => ['required', 'array'],
            'enrollments.*' => ['required', 'in:PASS,FAIL'],
        ]);

        $graded = 0;
        $skipped = 0;

        foreach ($request->enrollments as $enrollmentId => $grade) {
            $enrollment = Enrollment::with('student')->find($enrollmentId);

            // Verify enrollment exists and belongs to this module
            if (!$enrollment || $enrollment->module_id !== $module->id) {
                continue;
            }

            // ✅ FIX: Skip if student is null
            if (!$enrollment->student) {
                $skipped++;
                continue;
            }

            // Skip if already graded
            if ($enrollment->status !== 'active') {
                continue;
            }

            // Update enrollment
            $enrollment->status = 'completed';
            $enrollment->completed_at = now();
            $enrollment->pass_status = $grade;
            $enrollment->save();

            $graded++;
        }

        if ($graded > 0) {
            $message = "Successfully graded {$graded} student(s).";
            if ($skipped > 0) {
                $message .= " {$skipped} enrollment(s) skipped (students removed).";
            }
            return back()->with('success', $message);
        }

        return back()->with('error', 'No students were graded. They may have already been evaluated or removed.');
    }
}