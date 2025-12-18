<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;

class EnrollmentPolicy
{
    public function viewAny(Admin|Teacher|Student $user): bool
    {
        return true;
    }

    public function view(Admin|Teacher|Student $user, Enrollment $enrollment): bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        if ($user instanceof Teacher) {
            return $user->teachesModule($enrollment->module);
        }

        if ($user instanceof Student) {
            return $enrollment->student_id === $user->id;
        }

        return false;
    }

    public function create(Student $user): bool
    {
        return $user->canEnrollInMoreModules();
    }

    public function delete(Admin $user, Enrollment $enrollment): bool
    {
        return true; // Only admins can remove enrollments
    }

    public function grade(Teacher $user, Enrollment $enrollment): bool
    {
        return $user->teachesModule($enrollment->module) && $enrollment->isActive();
    }
}