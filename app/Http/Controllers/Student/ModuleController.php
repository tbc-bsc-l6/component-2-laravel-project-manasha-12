<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Show available modules for enrollment
     */
    public function available()
    {
        $student = Auth::guard('student')->user();
        
        // Check current enrollments
        $currentEnrollments = Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->count();

        // Check if student can enroll in more modules
        if ($currentEnrollments >= 4) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You have reached the maximum of 4 active module enrollments.');
        }

        // Get currently enrolled module IDs
        $enrolledModuleIds = Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->pluck('module_id')
            ->toArray();

        // Get available modules (not already enrolled, and available)
        $availableModules = Module::where('is_available', true)
            ->whereNotIn('id', $enrolledModuleIds)
            ->withCount('activeEnrollments')
            ->get()
            ->filter(function ($module) {
                return $module->active_enrollments_count < $module->max_students;
            });

        $stats = [
            'current_enrollments' => $currentEnrollments,
            'available_slots' => 4 - $currentEnrollments,
            'available_modules' => $availableModules->count(),
        ];

        return view('student.modules.available', compact('availableModules', 'stats'));
    }

    /**
     * Enroll student in a module
     */
    public function enroll(Request $request, Module $module)
    {
        $student = Auth::guard('student')->user();

        // Check if module is available
        if (!$module->is_available) {
            return back()->with('error', 'This module is not currently available for enrollment.');
        }

        // Check current enrollments
        $currentEnrollments = Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->count();

        if ($currentEnrollments >= 4) {
            return back()->with('error', 'You have reached the maximum of 4 active module enrollments.');
        }

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('student_id', $student->id)
            ->where('module_id', $module->id)
            ->where('status', 'active')
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'You are already enrolled in this module.');
        }

        // Check if module is full
        $enrollmentCount = Enrollment::where('module_id', $module->id)
            ->where('status', 'active')
            ->count();

        if ($enrollmentCount >= $module->max_students) {
            return back()->with('error', 'This module is full. Maximum capacity reached.');
        }

        // Create enrollment
        Enrollment::create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'enrolled_at' => now(),
            'status' => 'active',
            'pass_status' => 'pending',
        ]);

        return back()->with('success', "Successfully enrolled in {$module->name}!");
    }

    /**
     * Show current modules (active enrollments)
     */
    public function current()
    {
        $student = Auth::guard('student')->user();

        $currentModules = Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('module')
            ->orderBy('enrolled_at', 'desc')
            ->get();

        $stats = [
            'current_enrollments' => $currentModules->count(),
            'available_slots' => 4 - $currentModules->count(),
        ];

        return view('student.modules.current', compact('currentModules', 'stats'));
    }

    /**
     * Show module history (completed modules with PASS/FAIL)
     */
    public function history()
    {
        $isOldStudent = Auth::guard('old_student')->check();
        $student = $isOldStudent 
            ? Auth::guard('old_student')->user() 
            : Auth::guard('student')->user();

        $completedModules = Enrollment::where('student_id', $student->id)
            ->where('status', 'completed')
            ->with('module')
            ->orderBy('completed_at', 'desc')
            ->get();

        $stats = [
            'total_completed' => $completedModules->count(),
            'total_passed' => $completedModules->where('pass_status', 'PASS')->count(),
            'total_failed' => $completedModules->where('pass_status', 'FAIL')->count(),
            'pass_rate' => $completedModules->count() > 0 
                ? round(($completedModules->where('pass_status', 'PASS')->count() / $completedModules->count()) * 100, 1)
                : 0,
        ];

        return view('student.modules.history', compact('completedModules', 'stats', 'isOldStudent'));
    }

    /**
     * Show module details
     */
    public function show(Module $module)
    {
        $student = Auth::guard('student')->check() 
            ? Auth::guard('student')->user() 
            : Auth::guard('old_student')->user();

        // Check if student is enrolled
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('module_id', $module->id)
            ->first();

        // Get enrollment stats for the module
        $enrollmentCount = Enrollment::where('module_id', $module->id)
            ->where('status', 'active')
            ->count();

        $spotsAvailable = $module->max_students - $enrollmentCount;

        return view('student.modules.show', compact('module', 'enrollment', 'spotsAvailable'));
    }
}