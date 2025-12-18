<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Student::firstOrCreate(
                ['email' => "student{$i}@university.edu"],
                [
                    'name' => "Student {$i}",
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}