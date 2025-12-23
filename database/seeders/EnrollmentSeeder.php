<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Module;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all modules and students
        $modules = Module::all();
        $students = Student::all();

        if ($modules->isEmpty()) {
            $this->command->error('No modules found! Please run ModuleSeeder first.');
            return;
        }

        if ($students->isEmpty()) {
            $this->command->error('No students found! Please run StudentSeeder first.');
            return;
        }

        $this->command->info('Creating enrollments...');

        $createdCount = 0;

        // Iterate through each student
        foreach ($students as $student) {
            // Each student enrolls in 2-5 random modules
            $numberOfModules = rand(2, 5);
            $selectedModules = $modules->random(min($numberOfModules, $modules->count()));

            foreach ($selectedModules as $module) {
                // Check if enrollment already exists
                $exists = Enrollment::where('student_id', $student->id)
                    ->where('module_id', $module->id)
                    ->exists();

                if ($exists) {
                    continue; // Skip if already enrolled
                }

                // Check if module is full
                $currentEnrollments = Enrollment::where('module_id', $module->id)
                    ->where('status', 'active')
                    ->count();

                if ($currentEnrollments >= $module->max_students) {
                    continue; // Skip if module is full
                }

                // Create enrollment using Eloquent (handles nullable fields properly)
                $enrollmentData = $this->generateEnrollmentData($student->id, $module->id);
                Enrollment::create($enrollmentData);
                $createdCount++;
            }
        }

        $this->command->info("Successfully created {$createdCount} enrollments!");
    }

    /**
     * Generate enrollment data with realistic values
     */
    private function generateEnrollmentData(int $studentId, int $moduleId): array
    {
        // Random status distribution: 70% active, 20% completed, 10% dropped
        $statusRand = rand(1, 100);
        
        if ($statusRand <= 70) {
            // Active enrollment
            return [
                'student_id' => $studentId,
                'module_id' => $moduleId,
                'enrolled_at' => Carbon::now()->subDays(rand(1, 90)),
                'status' => 'active',
                // Don't include completed_at and pass_status for active enrollments
            ];
        } elseif ($statusRand <= 90) {
            // Completed enrollment
            $enrolledAt = Carbon::now()->subDays(rand(100, 180));
            $completedAt = Carbon::now()->subDays(rand(1, 50));
            
            // 80% pass, 20% fail for completed enrollments
            $passStatus = rand(1, 100) <= 80 ? 'PASS' : 'FAIL';
            
            return [
                'student_id' => $studentId,
                'module_id' => $moduleId,
                'enrolled_at' => $enrolledAt,
                'completed_at' => $completedAt,
                'status' => 'completed',
                'pass_status' => $passStatus,
            ];
        } else {
            // Dropped enrollment
            $enrolledAt = Carbon::now()->subDays(rand(60, 120));
            $completedAt = Carbon::now()->subDays(rand(1, 40));
            
            return [
                'student_id' => $studentId,
                'module_id' => $moduleId,
                'enrolled_at' => $enrolledAt,
                'completed_at' => $completedAt,
                'status' => 'dropped',
                // Don't include pass_status for dropped enrollments
            ];
        }
    }
}