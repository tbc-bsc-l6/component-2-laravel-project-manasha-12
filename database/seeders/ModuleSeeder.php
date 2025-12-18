<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'code' => 'AWE_14454',
                'name' => 'Advanced Web Engineering',
                'description' => 'Learn modern web development with Laravel and advanced patterns',
                'max_students' => 10,
                'is_available' => true,
            ],
            [
                'code' => 'DB_12345',
                'name' => 'Database Management Systems',
                'description' => 'Master database design and SQL',
                'max_students' => 10,
                'is_available' => true,
            ],
            [
                'code' => 'AI_67890',
                'name' => 'Artificial Intelligence',
                'description' => 'Introduction to AI and machine learning',
                'max_students' => 10,
                'is_available' => true,
            ],
            [
                'code' => 'SEC_11111',
                'name' => 'Cybersecurity Fundamentals',
                'description' => 'Learn security best practices',
                'max_students' => 10,
                'is_available' => true,
            ],
            [
                'code' => 'CC_22222',
                'name' => 'Cloud Computing',
                'description' => 'AWS, Azure, and cloud architecture',
                'max_students' => 10,
                'is_available' => true,
            ],
            [
                'code' => 'OLD_99999',
                'name' => 'Legacy System (Archived)',
                'description' => 'This module is no longer available',
                'max_students' => 10,
                'is_available' => false,
            ],
        ];

        foreach ($modules as $module) {
            Module::firstOrCreate(['code' => $module['code']], $module);
        }
    }
}