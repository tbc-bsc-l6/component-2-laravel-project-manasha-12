<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GradingController extends Controller
{
    /**
     * Display all modules with students pending grading
     */
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();

        // Get teacher's modules with enrollment counts
        $modules = $teacher->modules()
            ->withCount([
                'enrollments as total_students',
                'enrollments as pending_students' => function ($query) {
                    $query->where('status', 'active');
                },
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

        // Overall statistics
        $stats = [
            'total_pending' => $modules->sum('pending_students'),
            'total_completed' => $modules->sum('completed_students'),
            'total_passed' => $modules->sum('passed_students'),
            'total_failed' => $modules->sum('failed_students'),
        ];

        return view('teacher.grading.index', compact('modules', 'stats'));
    }

    /**
     * Display students for a specific module grouped for grading
     */
    public function showModule(Module $module)
    {
        $teacher = Auth::guard('teacher')->user();

        // Check if teacher is assigned to this module
        if (!$teacher->teachesModule($module)) {
            abort(403, 'You are not assigned to this module.');
        }

        // Get students grouped by status
        $pendingStudents = $module->enrollments()
            ->where('status', 'active')
            ->with('student')
            ->orderBy('enrolled_at', 'desc')
            ->get();

        $completedStudents = $module->enrollments()
            ->where('status', 'completed')
            ->with('student')
            ->orderBy('completed_at', 'desc')
            ->get();

        // Statistics for this module
        $stats = [
            'total' => $module->enrollments()->count(),
            'pending' => $pendingStudents->count(),
            'completed' => $completedStudents->count(),
            'passed' => $completedStudents->where('pass_status', 'pass')->count(),
            'failed' => $completedStudents->where('pass_status', 'fail')->count(),
            'pass_rate' => $completedStudents->count() > 0 
                ? round(($completedStudents->where('pass_status', 'pass')->count() / $completedStudents->count()) * 100, 1)
                : 0,
        ];

        return view('teacher.grading.module', compact('module', 'pendingStudents', 'completedStudents', 'stats'));
    }

    /**
     * Grade a single student
     */
    public function grade(Request $request, Enrollment $enrollment)
    {
        $teacher = Auth::guard('teacher')->user();

        // Verify teacher is assigned to this module
        if (!$teacher->teachesModule($enrollment->module)) {
            abort(403, 'You are not assigned to this module.');
        }

        // Verify enrollment is active
        if ($enrollment->status !== 'active') {
            return back()->with('error', 'This student has already been graded.');
        }

        // Validate grade
        $validated = $request->validate([
            'pass_status' => ['required', 'in:PASS,FAIL'],
        ]);

        $passStatus = $validated['pass_status'];
        $student = $enrollment->student;

        // Update enrollment
        $enrollment->status = 'completed';
        $enrollment->completed_at = now();
        $enrollment->pass_status = $passStatus;
        $enrollment->save();

        Log::info('Student graded', [
            'teacher_id' => $teacher->id,
            'student_id' => $student->id,
            'module_id' => $enrollment->module_id,
            'grade' => $passStatus,
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
            'grades' => ['required', 'array'],
            'grades.*.enrollment_id' => ['required', 'exists:enrollments,id'],
            'grades.*.pass_status' => ['required', 'in:PASS,FAIL'],
        ]);

        $graded = 0;

        foreach ($request->grades as $gradeData) {
            $enrollment = Enrollment::find($gradeData['enrollment_id']);

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
            $enrollment->pass_status = $gradeData['pass_status'];
            $enrollment->save();

            $graded++;
        }

        if ($graded > 0) {
            return back()->with('success', "Successfully graded {$graded} student(s).");
        }

        return back()->with('error', 'No students were graded. They may have already been evaluated.');
    }
}