<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Module;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of all enrollments
     */
    public function index()
    {
        $enrollments = Enrollment::with(['module', 'student'])
            ->orderBy('enrolled_at', 'desc')
            ->paginate(15);
        
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Remove student from module (delete enrollment)
     */
    public function destroy(Enrollment $enrollment)
    {
        // Get student and module info before deleting
        $studentName = $enrollment->student ? $enrollment->student->name : 'Unknown Student';
        $moduleName = $enrollment->module ? $enrollment->module->name : 'Unknown Module';
        
        // Delete the enrollment
        $enrollment->delete();

        return redirect()
            ->back()
            ->with('success', "Successfully removed {$studentName} from {$moduleName}!");
    }

    /**
     * View enrollments for a specific module
     */
    public function moduleEnrollments(Module $module)
    {
        $enrollments = $module->enrollments()
            ->with('student')
            ->orderBy('enrolled_at', 'desc')
            ->paginate(15);
        
        return view('admin.enrollments.module', compact('module', 'enrollments'));
    }

    /**
     * View enrollments for a specific student
     */
    public function studentEnrollments(Student $student)
    {
        $enrollments = $student->enrollments()
            ->with('module')
            ->orderBy('enrolled_at', 'desc')
            ->get();
        
        return view('admin.enrollments.student', compact('student', 'enrollments'));
    }

    /**
     * Get enrollment statistics
     */
    public function stats()
    {
        $stats = [
            'total_enrollments' => Enrollment::count(),
            'active_enrollments' => Enrollment::where('status', 'active')->count(),
            'completed_enrollments' => Enrollment::where('status', 'completed')->count(),
            'passed_students' => Enrollment::where('pass_status', 'PASS')->count(),
            'failed_students' => Enrollment::where('pass_status', 'FAIL')->count(),
        ];

        return view('admin.enrollments.stats', compact('stats'));
    }

    /**
     * Bulk remove students from a module
     */
    public function bulkRemove(Request $request, Module $module)
    {
        $validated = $request->validate([
            'enrollment_ids' => ['required', 'array'],
            'enrollment_ids.*' => ['exists:enrollments,id']
        ]);

        $count = Enrollment::whereIn('id', $validated['enrollment_ids'])
            ->where('module_id', $module->id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', "Successfully removed {$count} student(s) from {$module->name}!");
    }
}