<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;
use App\Models\Enrollment;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // List all users from all tables with search and sort
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'newest'); // Default to newest first

        // Get all users with their roles
        $admins = Admin::when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get()
            ->map(function($admin) {
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

        $teachers = Teacher::when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->withCount('modules')
            ->get()
            ->map(function($teacher) {
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

        $students = Student::when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->withCount('activeEnrollments')
            ->get()
            ->map(function($student) {
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

        $oldStudents = OldStudent::when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->withCount('completedEnrollments')
            ->get()
            ->map(function($oldStudent) {
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

        // Merge all users
        $allUsers = $admins->concat($teachers)->concat($students)->concat($oldStudents);

        // Apply sorting
        $allUsers = $this->sortUsers($allUsers, $sort);

        return view('admin.users.index', compact('allUsers'));
    }

    /**
     * Sort users based on selected criteria
     */
    private function sortUsers($users, $sortBy)
    {
        return match($sortBy) {
            'newest' => $users->sortByDesc('created_at'),
            'oldest' => $users->sortBy('created_at'),
            'name_asc' => $users->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE),
            'name_desc' => $users->sortByDesc('name', SORT_NATURAL | SORT_FLAG_CASE),
            default => $users->sortByDesc('created_at'),
        };
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

            // Handle special cases: student ↔ old_student
            if ($validated['current_role'] === 'student' && $validated['new_role'] === 'old_student') {
                $this->convertStudentToOldStudent($user);
            } 
            elseif ($validated['current_role'] === 'old_student' && $validated['new_role'] === 'student') {
                $this->convertOldStudentToStudent($user);
            }
            else {
                // General role change
                $this->changeGeneralRole($user, $validated['current_role'], $validated['new_role']);
            }

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

    /**
     * Convert Student to Old Student
     */
    private function convertStudentToOldStudent(Student $student)
    {
        // Create old student record first
        $oldStudent = OldStudent::create([
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
        ]);

        // Get all enrollments for this student
        $enrollments = Enrollment::where('student_id', $student->id)->get();

        foreach ($enrollments as $enrollment) {
            // Check if old_student already has an enrollment with same module and status
            $existingEnrollment = Enrollment::where('student_id', $oldStudent->id)
                ->where('module_id', $enrollment->module_id)
                ->where('status', $enrollment->status)
                ->first();

            if ($existingEnrollment) {
                // Duplicate exists - delete the student's enrollment
                $enrollment->delete();
            } else {
                // No duplicate - transfer this enrollment to old_student
                $enrollment->update(['student_id' => $oldStudent->id]);
            }
        }

        // Delete the student record
        $student->delete();
    }

    /**
     * Convert Old Student to Student
     */
    private function convertOldStudentToStudent(OldStudent $oldStudent)
    {
        // Create student record first
        $student = Student::create([
            'name' => $oldStudent->name,
            'email' => $oldStudent->email,
            'password' => $oldStudent->password,
        ]);

        // Get all enrollments for this old student
        $enrollments = Enrollment::where('student_id', $oldStudent->id)->get();

        foreach ($enrollments as $enrollment) {
            // Check if student already has an enrollment with same module and status
            $existingEnrollment = Enrollment::where('student_id', $student->id)
                ->where('module_id', $enrollment->module_id)
                ->where('status', $enrollment->status)
                ->first();

            if ($existingEnrollment) {
                // Duplicate exists - delete the old_student's enrollment
                $enrollment->delete();
            } else {
                // No duplicate - transfer this enrollment to student
                $enrollment->update(['student_id' => $student->id]);
            }
        }

        // Delete the old student record
        $oldStudent->delete();
    }

    /**
     * General role change (not student ↔ old_student)
     */
    private function changeGeneralRole($user, string $currentRole, string $newRole)
    {
        // Create user in new role table
        $newUser = $this->createUserInNewRole($newRole, [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        // Handle role-specific data transfer
        $this->handleRoleTransition($user, $newUser, $currentRole, $newRole);

        // Delete from old role table
        $user->delete();
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

    // Helper: Handle data transfer between roles (for general role changes)
    private function handleRoleTransition($oldUser, $newUser, string $oldRole, string $newRole)
    {
        // If changing FROM student/old_student to non-student role
        if (in_array($oldRole, ['student', 'old_student']) && !in_array($newRole, ['student', 'old_student'])) {
            // Complete all active enrollments first
            Enrollment::where('student_id', $oldUser->id)
                ->where('status', 'active')
                ->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                    'pass_status' => 'PASS',
                ]);
            
            // Then delete all enrollments (they're becoming teacher/admin)
            Enrollment::where('student_id', $oldUser->id)->delete();
        }

        // If changing TO student/old_student from non-student role
        // (No enrollments to transfer since they didn't have any as teacher/admin)

        // If changing from teacher, remove module assignments
        if ($oldRole === 'teacher' && $newRole !== 'teacher') {
            DB::table('module_teachers')
                ->where('teacher_id', $oldUser->id)
                ->delete();
        }

        // If both are teachers, transfer module assignments
        if ($oldRole === 'teacher' && $newRole === 'teacher') {
            DB::table('module_teachers')
                ->where('teacher_id', $oldUser->id)
                ->update(['teacher_id' => $newUser->id]);
        }
    }
}