<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\OldStudent;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of all users
     */
    public function index()
    {
        $admins = Admin::all();
        $teachers = Teacher::all();
        $students = Student::all();
        $oldStudents = OldStudent::all();

        return view('admin.users.index', compact('admins', 'teachers', 'students', 'oldStudents'));
    }

    /**
     * Change user role
     */
    public function changeRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'current_role' => 'required|string|in:admin,teacher,student,old_student',
            'new_role' => 'required|string|in:admin,teacher,student,old_student',
        ]);

        // Don't allow changing to the same role
        if ($validated['current_role'] === $validated['new_role']) {
            return redirect()->route('admin.users.index')
                ->with('error', 'User is already in this role.');
        }

        try {
            DB::beginTransaction();

            // Get user from current role table
            $user = $this->getUserByRole($validated['user_id'], $validated['current_role']);

            if (!$user) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'User not found.');
            }

            // Handle Student to Old Student conversion (special case)
            if ($validated['current_role'] === 'student' && $validated['new_role'] === 'old_student') {
                $this->convertStudentToOldStudent($user);
            }
            // Handle Old Student to Student conversion (special case)
            elseif ($validated['current_role'] === 'old_student' && $validated['new_role'] === 'student') {
                $this->convertOldStudentToStudent($user);
            }
            // Handle all other role changes
            else {
                $this->changeUserRole($user, $validated['current_role'], $validated['new_role']);
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User role changed successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to change user role: ' . $e->getMessage());
        }
    }

    /**
     * Convert Student to Old Student
     * This handles the unique constraint by completing enrollments before changing student_id
     */
    private function convertStudentToOldStudent(Student $student)
    {
        // Step 1: Complete all active enrollments first (changes status from 'active' to 'completed')
        // This prevents unique constraint violation on (student_id, module_id, status)
        Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->update([
                'status' => 'completed',
                'completed_at' => now(),
                'pass_status' => 'PASS', // Default to pass when converting to old student
            ]);

        // Step 2: Create old student record with same ID to maintain referential integrity
        $oldStudent = OldStudent::create([
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
        ]);

        // Step 3: Update enrollments to point to old_student
        // Since we already changed status to 'completed', the unique constraint won't be violated
        Enrollment::where('student_id', $student->id)
            ->update(['student_id' => $oldStudent->id]);

        // Step 4: Delete the student record
        $student->delete();
    }

    /**
     * Convert Old Student back to Student
     */
    private function convertOldStudentToStudent(OldStudent $oldStudent)
    {
        // Create student record
        $student = Student::create([
            'name' => $oldStudent->name,
            'email' => $oldStudent->email,
            'password' => $oldStudent->password,
        ]);

        // Update all enrollments to point to the new student
        Enrollment::where('student_id', $oldStudent->id)
            ->update(['student_id' => $student->id]);

        // Delete the old student record
        $oldStudent->delete();
    }

    /**
     * Change user role (for non-student conversions)
     */
    private function changeUserRole($user, string $currentRole, string $newRole)
    {
        // Prepare user data
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ];

        // If changing from student to non-student role, handle enrollments
        if ($currentRole === 'student') {
            // Complete all active enrollments first
            Enrollment::where('student_id', $user->id)
                ->where('status', 'active')
                ->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                    'pass_status' => 'PASS',
                ]);
            
            // Then delete all enrollments since they're becoming teacher/admin
            Enrollment::where('student_id', $user->id)->delete();
        }

        // Create new user in target role table
        $this->createUserInRole($userData, $newRole);

        // Delete old user record
        $user->delete();
    }

    /**
     * Get user by role
     */
    private function getUserByRole(int $userId, string $role)
    {
        return match($role) {
            'admin' => Admin::find($userId),
            'teacher' => Teacher::find($userId),
            'student' => Student::find($userId),
            'old_student' => OldStudent::find($userId),
            default => null,
        };
    }

    /**
     * Create user in specific role table
     */
    private function createUserInRole(array $userData, string $role)
    {
        return match($role) {
            'admin' => Admin::create($userData),
            'teacher' => Teacher::create($userData),
            'student' => Student::create($userData),
            'old_student' => OldStudent::create($userData),
        };
    }
}