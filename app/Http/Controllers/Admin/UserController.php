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
     */
    private function convertStudentToOldStudent(Student $student)
    {
        // Step 1: Complete all active enrollments first
        Enrollment::where('student_id', $student->id)
            ->where('status', 'active')
            ->update([
                'status' => 'completed',
                'completed_at' => now(),
                'pass_status' => 'PASS',
            ]);

        // Step 2: Create old student record
        $oldStudent = OldStudent::create([
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
        ]);

        // Step 3: Handle enrollment conflicts individually
        $studentEnrollments = Enrollment::where('student_id', $student->id)->get();

        foreach ($studentEnrollments as $enrollment) {
            // Check for duplicate
            $duplicate = Enrollment::where('student_id', $oldStudent->id)
                ->where('module_id', $enrollment->module_id)
                ->where('status', $enrollment->status)
                ->exists();

            if ($duplicate) {
                // Delete the student's enrollment (keep the old student's existing one)
                $enrollment->delete();
            } else {
                // Transfer this enrollment
                $enrollment->update(['student_id' => $oldStudent->id]);
            }
        }

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

        // Check for conflicting enrollments and handle them
        $oldEnrollments = Enrollment::where('student_id', $oldStudent->id)->get();

        foreach ($oldEnrollments as $enrollment) {
            // Check if the new student already has an enrollment in this module with the same status
            $existingEnrollment = Enrollment::where('student_id', $student->id)
                ->where('module_id', $enrollment->module_id)
                ->where('status', $enrollment->status)
                ->first();

            if ($existingEnrollment) {
                // Delete the old enrollment to avoid conflict
                $enrollment->delete();
            } else {
                // Safe to update
                $enrollment->update(['student_id' => $student->id]);
            }
        }

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
        return match ($role) {
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
        return match ($role) {
            'admin' => Admin::create($userData),
            'teacher' => Teacher::create($userData),
            'student' => Student::create($userData),
            'old_student' => OldStudent::create($userData),
        };
    }
}
