<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
            AdminSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            ModuleSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}