<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;
use App\Models\Enrollment;  // ← ADD THIS LINE
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // List all users from all tables
    public function index()
    {
        // Get all users with their roles
        $admins = Admin::all()->map(function($admin) {
            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => 'admin',
                'role_display' => 'Administrator',
                'created_at' => $admin->created_at,
                'model' => $admin
            ];
        });

        $teachers = Teacher::withCount('modules')->get()->map(function($teacher) {
            return [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'email' => $teacher->email,
                'role' => 'teacher',
                'role_display' => 'Teacher',
                'modules_count' => $teacher->modules_count,
                'created_at' => $teacher->created_at,
                'model' => $teacher
            ];
        });

        $students = Student::withCount('activeEnrollments')->get()->map(function($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'role' => 'student',
                'role_display' => 'Student',
                'enrollments_count' => $student->active_enrollments_count,
                'created_at' => $student->created_at,
                'model' => $student
            ];
        });

        $oldStudents = OldStudent::withCount('completedEnrollments')->get()->map(function($oldStudent) {
            return [
                'id' => $oldStudent->id,
                'name' => $oldStudent->name,
                'email' => $oldStudent->email,
                'role' => 'old_student',
                'role_display' => 'Old Student',
                'completed_count' => $oldStudent->completed_enrollments_count,
                'created_at' => $oldStudent->created_at,
                'model' => $oldStudent
            ];
        });

        // Merge all users and sort by created_at
        $allUsers = $admins->concat($teachers)->concat($students)->concat($oldStudents)
            ->sortByDesc('created_at');

        return view('admin.users.index', compact('allUsers'));
    }

    // Change user role
    public function changeRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer'],
            'current_role' => ['required', 'in:admin,teacher,student,old_student'],
            'new_role' => ['required', 'in:admin,teacher,student,old_student'],
        ]);

        // Prevent changing if same role
        if ($validated['current_role'] === $validated['new_role']) {
            return redirect()
                ->back()
                ->with('error', 'User already has this role!');
        }

        DB::beginTransaction();
        
        try {
            // Get the user from current role table
            $user = $this->getUserByRole($validated['current_role'], $validated['user_id']);
            
            if (!$user) {
                return redirect()
                    ->back()
                    ->with('error', 'User not found!');
            }

            // Create user in new role table
            $newUser = $this->createUserInNewRole($validated['new_role'], [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password, // Keep same password
            ]);

            // Handle role-specific data transfer
            $this->handleRoleTransition($user, $newUser, $validated['current_role'], $validated['new_role']);

            // Delete from old role table
            $user->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'User role changed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->with('error', 'Failed to change user role: ' . $e->getMessage());
        }
    }

    // Helper: Get user by role
    private function getUserByRole(string $role, int $id)
    {
        return match($role) {
            'admin' => Admin::find($id),
            'teacher' => Teacher::find($id),
            'student' => Student::find($id),
            'old_student' => OldStudent::find($id),
            default => null
        };
    }

    // Helper: Create user in new role table
    private function createUserInNewRole(string $role, array $data)
    {
        return match($role) {
            'admin' => Admin::create($data),
            'teacher' => Teacher::create($data),
            'student' => Student::create($data),
            'old_student' => OldStudent::create($data),
            default => null
        };
    }

    // Helper: Handle data transfer between roles
    private function handleRoleTransition($oldUser, $newUser, string $oldRole, string $newRole)
    {
        // If changing from student to old_student or vice versa, update enrollments
        if (($oldRole === 'student' && $newRole === 'old_student') || 
            ($oldRole === 'old_student' && $newRole === 'student')) {
            
            // Update enrollment user_id references
            Enrollment::where('student_id', $oldUser->id)
                ->update(['student_id' => $newUser->id]);
        }

        // If changing from teacher, remove module assignments
        if ($oldRole === 'teacher') {
            DB::table('module_teachers')
                ->where('teacher_id', $oldUser->id)
                ->delete();
        }

        // If changing to teacher and from teacher, transfer module assignments
        if ($oldRole === 'teacher' && $newRole === 'teacher') {
            DB::table('module_teachers')
                ->where('teacher_id', $oldUser->id)
                ->update(['teacher_id' => $newUser->id]);
        }
    }
}