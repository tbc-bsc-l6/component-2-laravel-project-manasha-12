<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;
use App\Policies\ModulePolicy;
use App\Policies\EnrollmentPolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Module::class => ModulePolicy::class,
        Enrollment::class => EnrollmentPolicy::class,
        Student::class => StudentPolicy::class,
        Teacher::class => TeacherPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}