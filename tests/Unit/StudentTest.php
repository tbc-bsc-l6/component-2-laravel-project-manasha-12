<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test student can enroll in modules up to maximum limit.
     */
    public function test_student_can_enroll_up_to_four_modules(): void
    {
        $student = Student::factory()->create();

        // Student with 0 enrollments can enroll
        $this->assertTrue($student->canEnrollInMoreModules());
        $this->assertEquals(4, $student->getRemainingSlots());

        // Create 3 active enrollments
        Enrollment::factory()->count(3)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        $student->refresh();
        
        // Student with 3 enrollments can still enroll
        $this->assertTrue($student->canEnrollInMoreModules());
        $this->assertEquals(1, $student->getRemainingSlots());
        $this->assertEquals(3, $student->getActiveEnrollmentCount());
    }

    /**
     * Test student cannot enroll beyond maximum limit.
     */
    public function test_student_cannot_enroll_beyond_maximum_limit(): void
    {
        $student = Student::factory()->create();

        // Create 4 active enrollments (maximum)
        Enrollment::factory()->count(4)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        $student->refresh();

        // Student at maximum cannot enroll in more
        $this->assertFalse($student->canEnrollInMoreModules());
        $this->assertEquals(0, $student->getRemainingSlots());
        $this->assertEquals(4, $student->getActiveEnrollmentCount());
    }

    /**
     * Test completed enrollments don't count toward active limit.
     */
    public function test_completed_enrollments_do_not_count_toward_limit(): void
    {
        $student = Student::factory()->create();

        // Create 2 completed and 3 active enrollments
        Enrollment::factory()->count(2)->create([
            'student_id' => $student->id,
            'status' => 'completed',
        ]);

        Enrollment::factory()->count(3)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        $student->refresh();

        // Only active enrollments count toward limit
        $this->assertEquals(3, $student->getActiveEnrollmentCount());
        $this->assertTrue($student->canEnrollInMoreModules());
        $this->assertEquals(1, $student->getRemainingSlots());
    }

    /**
     * Test student enrollment status check for specific module.
     */
    public function test_student_can_check_enrollment_status_in_module(): void
    {
        $student = Student::factory()->create();
        $module1 = Module::factory()->create();
        $module2 = Module::factory()->create();

        // Enroll in module1 (active)
        Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module1->id,
            'status' => 'active',
        ]);

        // Complete module2
        Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module2->id,
            'status' => 'completed',
        ]);

        // Check enrollment status
        $this->assertTrue($student->isEnrolledIn($module1));
        $this->assertFalse($student->isEnrolledIn($module2)); // Completed, not active
        $this->assertTrue($student->hasCompletedModule($module2));
        $this->assertFalse($student->hasCompletedModule($module1));
    }

    /**
     * Test student role identification.
     */
    public function test_student_role_identification(): void
    {
        $student = Student::factory()->create();

        $this->assertEquals('student', $student->getRole());
        $this->assertTrue($student->isStudent());
    }

    /**
     * Test student relationships are properly defined.
     */
    public function test_student_has_proper_relationships(): void
    {
        $student = Student::factory()->create();
        $module = Module::factory()->create();

        // Create enrollments
        Enrollment::factory()->count(2)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        Enrollment::factory()->count(3)->create([
            'student_id' => $student->id,
            'status' => 'completed',
        ]);

        // Test relationships load correctly
        $this->assertCount(5, $student->enrollments);
        $this->assertCount(2, $student->activeEnrollments);
        $this->assertCount(3, $student->completedEnrollments);
    }
}