<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Dr. John Smith', 'email' => 'john.smith@university.edu'],
            ['name' => 'Prof. Jane Doe', 'email' => 'jane.doe@university.edu'],
            ['name' => 'Dr. Michael Brown', 'email' => 'michael.brown@university.edu'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::firstOrCreate(
                ['email' => $teacher['email']],
                [
                    'name' => $teacher['name'],
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}