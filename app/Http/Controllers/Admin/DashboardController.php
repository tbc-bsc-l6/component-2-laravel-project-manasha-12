<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics
     */
    public function index()
    {
        // Calculate statistics
        $stats = [
            'total_modules' => Module::count(),
            'active_modules' => Module::where('is_available', true)->count(),
            'total_teachers' => Teacher::count(),
            'total_students' => Student::count(),
            'active_enrollments' => Enrollment::where('status', 'active')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}