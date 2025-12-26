<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display teacher dashboard
     */
    public function index()
    {
        try {
            $teacher = Auth::guard('teacher')->user();

            // Get teacher's assigned modules with counts
            $modules = $teacher->modules()
                ->withCount([
                    'activeEnrollments',
                    'enrollments as completed_count' => function ($query) {
                        $query->where('status', 'completed');
                    },
                    'enrollments as pending_count' => function ($query) {
                        $query->where('status', 'active');
                    }
                ])
                ->get();

            // Get module IDs for the teacher
            $moduleIds = $modules->pluck('id')->toArray();

            // Statistics - using simpler queries
            $stats = [
                'total_modules' => $modules->count(),
                'total_students' => empty($moduleIds) ? 0 : Enrollment::whereIn('module_id', $moduleIds)
                    ->where('status', 'active')
                    ->distinct('student_id')
                    ->count('student_id'),
                'pending_evaluations' => empty($moduleIds) ? 0 : Enrollment::whereIn('module_id', $moduleIds)
                    ->where('status', 'active')
                    ->count(),
                'completed_evaluations' => empty($moduleIds) ? 0 : Enrollment::whereIn('module_id', $moduleIds)
                    ->where('status', 'completed')
                    ->count(),
            ];

            return view('teacher.dashboard', compact('modules', 'stats'));
            
        } catch (\Exception $e) {
            // Return with default values
            $modules = collect([]);
            $stats = [
                'total_modules' => 0,
                'total_students' => 0,
                'pending_evaluations' => 0,
                'completed_evaluations' => 0,
            ];
            
            return view('teacher.dashboard', compact('modules', 'stats'))
                ->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }
}