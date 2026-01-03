<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is old student or active student
        $isOldStudent = Auth::guard('old_student')->check();
        $student = $isOldStudent 
            ? Auth::guard('old_student')->user() 
            : Auth::guard('student')->user();

        if ($isOldStudent) {
            // Old Student Dashboard - Only show completed modules
            $completedModules = Enrollment::where('student_id', $student->id)
                ->where('status', 'completed')
                ->with('module')
                ->orderBy('completed_at', 'desc')
                ->get();

            // Use filter for case-insensitive comparison
            $totalPassed = $completedModules->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'PASS';
            })->count();

            $totalFailed = $completedModules->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'FAIL';
            })->count();

            $stats = [
                'total_completed' => $completedModules->count(),
                'total_passed' => $totalPassed,
                'total_failed' => $totalFailed,
                'pass_rate' => $completedModules->count() > 0 
                    ? round(($totalPassed / $completedModules->count()) * 100, 1)
                    : 0,
            ];

            return view('student.dashboard-old', compact('student', 'completedModules', 'stats'));
        } else {
            // Active Student Dashboard
            $currentModules = Enrollment::where('student_id', $student->id)
                ->where('status', 'active')
                ->with('module')
                ->get();

            $completedModules = Enrollment::where('student_id', $student->id)
                ->where('status', 'completed')
                ->with('module')
                ->orderBy('completed_at', 'desc')
                ->get();

            // Use filter for case-insensitive comparison
            $totalPassed = $completedModules->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'PASS';
            })->count();

            $totalFailed = $completedModules->filter(function($enrollment) {
                return strtoupper(trim($enrollment->pass_status ?? '')) === 'FAIL';
            })->count();

            $stats = [
                'current_enrollments' => $currentModules->count(),
                'available_slots' => 4 - $currentModules->count(),
                'total_completed' => $completedModules->count(),
                'total_passed' => $totalPassed,
                'total_failed' => $totalFailed,
                'can_enroll' => $currentModules->count() < 4,
            ];

            return view('student.dashboard', compact('student', 'currentModules', 'completedModules', 'stats'));
        }
    }
}