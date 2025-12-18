<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator with full access'],
            ['name' => 'teacher', 'description' => 'Teacher can manage assigned modules'],
            ['name' => 'student', 'description' => 'Active student can enroll in modules'],
            ['name' => 'old_student', 'description' => 'Student who completed all modules'],
        ];

        foreach ($roles as $role) {
            UserRole::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}