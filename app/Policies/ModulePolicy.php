<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Module;
use App\Models\Student;
use App\Models\Teacher;

class ModulePolicy
{
    // Admin can do everything
    public function viewAny(Admin|Teacher|Student $user): bool
    {
        return true;
    }

    public function view(Admin|Teacher|Student $user, Module $module): bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        if ($user instanceof Teacher) {
            return $user->teachesModule($module);
        }

        if ($user instanceof Student) {
            return $module->is_available || $user->isEnrolledIn($module);
        }

        return false;
    }

    public function create(Admin $user): bool
    {
        return true; // Only admins can create
    }

    public function update(Admin $user, Module $module): bool
    {
        return true; // Only admins can update
    }

    public function delete(Admin $user, Module $module): bool
    {
        return true; // Only admins can delete
    }

    public function enroll(Student $user, Module $module): bool
    {
        return $module->canEnroll() 
            && $user->canEnrollInMoreModules() 
            && !$user->isEnrolledIn($module)
            && !$user->hasCompletedModule($module);
    }

    public function assignTeacher(Admin $user, Module $module): bool
    {
        return true; // Only admins can assign teachers
    }

    public function toggleAvailability(Admin $user, Module $module): bool
    {
        return true; // Only admins can toggle
    }
}