<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test student can successfully enroll in available module.
     */
    public function test_student_can_enroll_in_available_module(): void
    {
        $student = Student::factory()->createOne();
        $module = Module::factory()->createOne([
            'is_available' => true,
            'max_students' => 10,
        ]);

        // Act as student and enroll
        $response = $this->actingAs($student, 'student')
            ->post(route('student.modules.enroll', $module));

        // Assert enrollment was successful
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify enrollment exists in database
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Verify student is enrolled
        $this->assertTrue($student->fresh()->isEnrolledIn($module));
    }

    /**
     * Test student cannot enroll beyond 4 module limit.
     */
    public function test_student_cannot_enroll_beyond_four_modules(): void
    {
        $student = Student::factory()->createOne();
        
        // Enroll student in 4 modules
        Enrollment::factory()->count(4)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        // Try to enroll in 5th module
        $module = Module::factory()->createOne([
            'is_available' => true,
            'max_students' => 10,
        ]);

        $response = $this->actingAs($student, 'student')
            ->post(route('student.modules.enroll', $module));

        // Should be rejected
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Verify enrollment does not exist
        $this->assertDatabaseMissing('enrollments', [
            'student_id' => $student->id,
            'module_id' => $module->id,
        ]);
    }

    /**
     * Test student cannot enroll in full module.
     */
    public function test_student_cannot_enroll_in_full_module(): void
    {
        $student = Student::factory()->createOne();
        $module = Module::factory()->createOne([
            'is_available' => true,
            'max_students' => 2, // Small capacity
        ]);

        // Fill the module to capacity
        Enrollment::factory()->count(2)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Try to enroll
        $response = $this->actingAs($student, 'student')
            ->post(route('student.modules.enroll', $module));

        // Should be rejected
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Verify enrollment does not exist
        $this->assertDatabaseMissing('enrollments', [
            'student_id' => $student->id,
            'module_id' => $module->id,
        ]);
    }

    /**
     * Test student cannot enroll in unavailable module.
     */
    public function test_student_cannot_enroll_in_unavailable_module(): void
    {
        $student = Student::factory()->createOne();
        $module = Module::factory()->createOne([
            'is_available' => false, // Not available
            'max_students' => 10,
        ]);

        $response = $this->actingAs($student, 'student')
            ->post(route('student.modules.enroll', $module));

        // Should be rejected
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Verify enrollment does not exist
        $this->assertDatabaseMissing('enrollments', [
            'student_id' => $student->id,
            'module_id' => $module->id,
        ]);
    }

    /**
     * Test student cannot enroll in same module twice.
     */
    public function test_student_cannot_enroll_twice_in_same_module(): void
    {
        $student = Student::factory()->createOne();
        $module = Module::factory()->createOne([
            'is_available' => true,
            'max_students' => 10,
        ]);

        // First enrollment
        Enrollment::factory()->createOne([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Try to enroll again
        $response = $this->actingAs($student, 'student')
            ->post(route('student.modules.enroll', $module));

        // Should be rejected
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Should still only have 1 enrollment
        $this->assertEquals(1, Enrollment::where('student_id', $student->id)
            ->where('module_id', $module->id)
            ->count());
    }

    /**
     * Test student can view their current modules.
     */
    public function test_student_can_view_current_modules(): void
    {
        $student = Student::factory()->createOne();
        
        // Create active enrollments
        Enrollment::factory()->count(3)->create([
            'student_id' => $student->id,
            'status' => 'active',
        ]);

        $response = $this->actingAs($student, 'student')
            ->get(route('student.modules.current'));

        $response->assertOk();
        $response->assertViewHas('currentModules');
        
        // Check all modules are in view
        $modules = $response->viewData('currentModules');
        $this->assertCount(3, $modules);
    }

    /**
     * Test student can view available modules.
     */
    public function test_student_can_view_available_modules(): void
    {
        $student = Student::factory()->createOne();
        
        // Create available modules
        Module::factory()->count(5)->create([
            'is_available' => true,
            'max_students' => 10,
        ]);

        // Create unavailable module (should not appear)
        Module::factory()->createOne([
            'is_available' => false,
        ]);

        $response = $this->actingAs($student, 'student')
            ->get(route('student.modules.available'));

        $response->assertOk();
        $response->assertViewHas('availableModules');
    }
}