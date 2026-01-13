<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherGradingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test teacher can grade student as PASS.
     */
    public function test_teacher_can_grade_student_as_pass(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        /** @var Student $student */
        $student = Student::factory()->create();

        // Assign teacher to module
        $module->teachers()->attach($teacher->id, ['assigned_at' => now()]);

        // Create active enrollment
        /** @var Enrollment $enrollment */
        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Grade as PASS
        $response = $this->actingAs($teacher, 'teacher')
            ->post(route('teacher.modules.grade-student', [$module, $enrollment]), [
                'pass_status' => 'PASS',
            ]);

        // Assert successful
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify enrollment was updated
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'completed',
            'pass_status' => 'PASS',
        ]);

        // Verify completed_at was set
        $enrollment->refresh();
        $this->assertNotNull($enrollment->completed_at);
        $this->assertTrue($enrollment->isCompleted());
        $this->assertTrue($enrollment->hasPassed());
    }

    /**
     * Test teacher can grade student as FAIL.
     */
    public function test_teacher_can_grade_student_as_fail(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        /** @var Student $student */
        $student = Student::factory()->create();

        // Assign teacher to module
        $module->teachers()->attach($teacher->id);

        // Create active enrollment
        /** @var Enrollment $enrollment */
        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Grade as FAIL
        $response = $this->actingAs($teacher, 'teacher')
            ->post(route('teacher.modules.grade-student', [$module, $enrollment]), [
                'pass_status' => 'FAIL',
            ]);

        // Assert successful
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify enrollment was updated
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'completed',
            'pass_status' => 'FAIL',
        ]);

        $enrollment->refresh();
        $this->assertFalse($enrollment->hasPassed());
    }

    /**
     * Test teacher cannot grade student in module they don't teach.
     */
    public function test_teacher_cannot_grade_module_they_dont_teach(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        /** @var Student $student */
        $student = Student::factory()->create();

        // Teacher NOT assigned to module

        /** @var Enrollment $enrollment */
        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Try to grade
        $response = $this->actingAs($teacher, 'teacher')
            ->post(route('teacher.modules.grade-student', [$module, $enrollment]), [
                'pass_status' => 'PASS',
            ]);

        // Should be forbidden
        $response->assertForbidden();

        // Enrollment should remain active
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'active',
        ]);
    }

    /**
     * Test teacher cannot grade already completed enrollment.
     */
    public function test_teacher_cannot_grade_already_completed_enrollment(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        /** @var Student $student */
        $student = Student::factory()->create();

        $module->teachers()->attach($teacher->id);

        // Create completed enrollment
        /** @var Enrollment $enrollment */
        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'completed',
            'pass_status' => 'PASS',
            'completed_at' => now(),
        ]);

        // Try to grade again
        $response = $this->actingAs($teacher, 'teacher')
            ->post(route('teacher.modules.grade-student', [$module, $enrollment]), [
                'pass_status' => 'FAIL',
            ]);

        // Should show error
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Grade should not change
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'pass_status' => 'PASS', // Original grade preserved
        ]);
    }

    /**
     * Test teacher can view their assigned modules.
     */
    public function test_teacher_can_view_assigned_modules(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        
        // Create and assign modules
        $modules = Module::factory()->count(3)->create();
        foreach ($modules as $module) {
            $module->teachers()->attach($teacher->id);
        }

        $response = $this->actingAs($teacher, 'teacher')
            ->get(route('teacher.modules.index'));

        $response->assertOk();
        $response->assertViewHas('modules');
        
        $viewModules = $response->viewData('modules');
        $this->assertCount(3, $viewModules);
    }

    /**
     * Test teacher can view students in their module.
     */
    public function test_teacher_can_view_students_in_module(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        
        // Assign teacher
        $module->teachers()->attach($teacher->id);

        // Create enrollments
        Enrollment::factory()->count(5)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        $response = $this->actingAs($teacher, 'teacher')
            ->get(route('teacher.modules.show', $module));

        $response->assertOk();
        $response->assertViewHas('activeEnrollments');
        
        $enrollments = $response->viewData('activeEnrollments');
        $this->assertCount(5, $enrollments);
    }

    /**
     * Test grading validates pass_status input.
     */
    public function test_grading_requires_valid_pass_status(): void
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::factory()->create();
        /** @var Module $module */
        $module = Module::factory()->create();
        /** @var Student $student */
        $student = Student::factory()->create();

        $module->teachers()->attach($teacher->id);

        /** @var Enrollment $enrollment */
        $enrollment = Enrollment::factory()->create([
            'student_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        // Try with invalid status
        $response = $this->actingAs($teacher, 'teacher')
            ->post(route('teacher.modules.grade-student', [$module, $enrollment]), [
                'pass_status' => 'INVALID',
            ]);

        // Should fail validation
        $response->assertSessionHasErrors('pass_status');

        // Enrollment should remain active
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'active',
        ]);
    }
}