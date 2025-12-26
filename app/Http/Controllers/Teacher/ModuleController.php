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
                    $query->where('status', 'completed')->where('pass_status', 'PASS');
                },
                'enrollments as failed_students' => function ($query) {
                    $query->where('status', 'completed')->where('pass_status', 'FAIL');
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

        // Load module with students
        $module->load([
            'activeEnrollments.student',
            'enrollments' => function ($query) {
                $query->where('status', 'completed')->with('student');
            }
        ]);

        // Get active and completed enrollments separately
        $activeEnrollments = $module->activeEnrollments;
        $completedEnrollments = $module->enrollments->where('status', 'completed');

        // Statistics
        $stats = [
            'total_students' => $module->enrollments()->count(),
            'active_students' => $activeEnrollments->count(),
            'completed_students' => $completedEnrollments->count(),
            'passed_students' => $completedEnrollments->where('pass_status', 'PASS')->count(),
            'failed_students' => $completedEnrollments->where('pass_status', 'FAIL')->count(),
            'pass_rate' => $completedEnrollments->count() > 0 
                ? round(($completedEnrollments->where('pass_status', 'PASS')->count() / $completedEnrollments->count()) * 100, 1)
                : 0,
        ];

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

        // Verify enrollment is active
        if ($enrollment->status !== 'active') {
            return back()->with('error', 'This student has already been graded.');
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

        // Update enrollment with explicit values
        $enrollment->status = 'completed';
        $enrollment->completed_at = now();
        $enrollment->pass_status = $passStatus;
        $enrollment->save();

        // Refresh from database to confirm
        $enrollment->refresh();

        // Log after update
        Log::info('Grading student AFTER', [
            'enrollment_id' => $enrollment->id,
            'saved_status' => $enrollment->status,
            'saved_pass_status' => $enrollment->pass_status,
            'saved_completed_at' => $enrollment->completed_at,
        ]);

        return back()->with('success', "Successfully marked {$student->name} as {$passStatus}. Status saved: {$enrollment->pass_status}");
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

        foreach ($request->enrollments as $enrollmentId => $grade) {
            $enrollment = Enrollment::find($enrollmentId);

            // Verify enrollment exists and belongs to this module
            if (!$enrollment || $enrollment->module_id !== $module->id) {
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
            return back()->with('success', "Successfully graded {$graded} student(s).");
        }

        return back()->with('error', 'No students were graded. They may have already been evaluated.');
    }
}