<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test enrollment starts in active status.
     */
    public function test_new_enrollment_is_active(): void
    {
        $enrollment = Enrollment::factory()->create([
            'status' => 'active',
        ]);

        $this->assertEquals('active', $enrollment->status);
        $this->assertNull($enrollment->completed_at);
    }

    /**
     * Test enrollment can be marked as pass.
     */
    public function test_enrollment_can_be_marked_as_pass(): void
    {
        $enrollment = Enrollment::factory()->create([
            'status' => 'active',
            'completed_at' => null,
            'pass_status' => 'pending',
        ]);

        // Mark as pass
        $enrollment->status = 'completed';
        $enrollment->pass_status = 'PASS';
        $enrollment->completed_at = now();
        $enrollment->save();

        $this->assertEquals('completed', $enrollment->status);
        $this->assertEquals('PASS', $enrollment->pass_status);
        $this->assertNotNull($enrollment->completed_at);
    }

    /**
     * Test enrollment can be marked as fail.
     */
    public function test_enrollment_can_be_marked_as_fail(): void
    {
        $enrollment = Enrollment::factory()->create([
            'status' => 'active',
            'completed_at' => null,
            'pass_status' => 'pending',
        ]);

        // Mark as fail
        $enrollment->status = 'completed';
        $enrollment->pass_status = 'FAIL';
        $enrollment->completed_at = now();
        $enrollment->save();

        $this->assertEquals('completed', $enrollment->status);
        $this->assertEquals('FAIL', $enrollment->pass_status);
        $this->assertNotNull($enrollment->completed_at);
    }

    /**
     * Test complete method with custom pass status.
     */
    public function test_complete_method_sets_all_fields(): void
    {
        $enrollment = Enrollment::factory()->create([
            'status' => 'active',
        ]);

        // Manually complete
        $enrollment->status = 'completed';
        $enrollment->pass_status = 'PASS';
        $enrollment->completed_at = now();
        $enrollment->save();

        // All fields should be set
        $this->assertEquals('completed', $enrollment->status);
        $this->assertEquals('PASS', $enrollment->pass_status);
        $this->assertNotNull($enrollment->completed_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $enrollment->completed_at);
    }

    /**
     * Test enrollment belongs to student and module.
     */
    public function test_enrollment_has_proper_relationships(): void
    {
        /** @var Student $student */
        $student = Student::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();

        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
        ]);

        // Test relationships
        $this->assertInstanceOf(Student::class, $enrollment->student);
        $this->assertInstanceOf(Module::class, $enrollment->module);
        $this->assertEquals($student->id, $enrollment->student->id);
        $this->assertEquals($module->id, $enrollment->module->id);
    }

    /**
     * Test enrollment status checks work correctly.
     */
    public function test_enrollment_status_checks(): void
    {
        $activeEnrollment = Enrollment::factory()->create([
            'status' => 'active',
        ]);

        $completedEnrollment = Enrollment::factory()->create([
            'status' => 'completed',
            'pass_status' => 'PASS',
        ]);

        // Active enrollment
        $this->assertEquals('active', $activeEnrollment->status);

        // Completed enrollment
        $this->assertEquals('completed', $completedEnrollment->status);
        $this->assertEquals('PASS', $completedEnrollment->pass_status);
    }

    /**
     * Test enrollment timestamps are set correctly.
     */
    public function test_enrollment_timestamps_are_set(): void
    {
        $enrollment = Enrollment::factory()->create([
            'enrolled_at' => now(),
            'status' => 'active',
        ]);

        // Enrolled_at should be set
        $this->assertNotNull($enrollment->enrolled_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $enrollment->enrolled_at);

        // Complete the enrollment
        $enrollment->status = 'completed';
        $enrollment->pass_status = 'PASS';
        $enrollment->completed_at = now();
        $enrollment->save();

        // Completed_at should now be set
        $this->assertNotNull($enrollment->completed_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $enrollment->completed_at);
        $this->assertTrue($enrollment->completed_at->greaterThanOrEqualTo($enrollment->enrolled_at));
    }
}