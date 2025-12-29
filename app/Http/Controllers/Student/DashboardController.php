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

            $stats = [
                'total_completed' => $completedModules->count(),
                'total_passed' => $completedModules->where('pass_status', 'PASS')->count(),
                'total_failed' => $completedModules->where('pass_status', 'FAIL')->count(),
                'pass_rate' => $completedModules->count() > 0 
                    ? round(($completedModules->where('pass_status', 'PASS')->count() / $completedModules->count()) * 100, 1)
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

            $stats = [
                'current_enrollments' => $currentModules->count(),
                'available_slots' => 4 - $currentModules->count(),
                'total_completed' => $completedModules->count(),
                'total_passed' => $completedModules->where('pass_status', 'PASS')->count(),
                'total_failed' => $completedModules->where('pass_status', 'FAIL')->count(),
                'can_enroll' => $currentModules->count() < 4,
            ];

            return view('student.dashboard', compact('student', 'currentModules', 'completedModules', 'stats'));
        }
    }
}