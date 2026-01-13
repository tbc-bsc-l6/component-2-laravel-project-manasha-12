<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test module capacity management.
     */
    public function test_module_tracks_available_spots_correctly(): void
    {
        $module = Module::factory()->create([
            'max_students' => 10,
            'is_available' => true,
        ]);

        // Initially all spots available
        $this->assertTrue($module->hasAvailableSpots());
        $this->assertEquals(10, $module->available_spots);
        $this->assertTrue($module->canEnroll());

        // Add 7 active enrollments
        Enrollment::factory()->count(7)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        $module->refresh();

        // 3 spots remaining
        $this->assertTrue($module->hasAvailableSpots());
        $this->assertEquals(3, $module->available_spots);
        $this->assertEquals(7, $module->getCurrentEnrollmentCount());
    }

    /**
     * Test module at full capacity.
     */
    public function test_module_at_full_capacity_has_no_spots(): void
    {
        $module = Module::factory()->create([
            'max_students' => 10,
            'is_available' => true,
        ]);

        // Fill module to capacity
        Enrollment::factory()->count(10)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        $module->refresh();

        // No spots available
        $this->assertFalse($module->hasAvailableSpots());
        $this->assertEquals(0, $module->available_spots);
        $this->assertFalse($module->canEnroll());
        $this->assertEquals(10, $module->getCurrentEnrollmentCount());
    }

    /**
     * Test completed enrollments don't count toward capacity.
     */
    public function test_completed_enrollments_do_not_count_toward_capacity(): void
    {
        $module = Module::factory()->create([
            'max_students' => 10,
            'is_available' => true,
        ]);

        // 5 active + 8 completed enrollments
        Enrollment::factory()->count(5)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        Enrollment::factory()->count(8)->create([
            'module_id' => $module->id,
            'status' => 'completed',
        ]);

        $module->refresh();

        // Only active count toward capacity (5/10)
        $this->assertTrue($module->hasAvailableSpots());
        $this->assertEquals(5, $module->available_spots);
        $this->assertEquals(5, $module->getCurrentEnrollmentCount());
    }

    /**
     * Test unavailable module cannot be enrolled in.
     */
    public function test_unavailable_module_cannot_be_enrolled(): void
    {
        $module = Module::factory()->create([
            'max_students' => 10,
            'is_available' => false, // Unavailable
        ]);

        // Has spots but unavailable
        $this->assertTrue($module->hasAvailableSpots());
        $this->assertFalse($module->canEnroll());
    }

    /**
     * Test teacher assignment to module.
     */
    public function test_teacher_can_be_assigned_to_module(): void
    {
        $module = Module::factory()->create();
        $teacher1 = Teacher::factory()->create();
        $teacher2 = Teacher::factory()->create();

        // Assign teacher1 to module
        $module->teachers()->attach($teacher1->id, [
            'assigned_at' => now(),
        ]);

        // Check assignment
        $this->assertTrue($module->isAssignedToTeacher($teacher1));
        $this->assertFalse($module->isAssignedToTeacher($teacher2));
        $this->assertCount(1, $module->teachers);
    }

    /**
     * Test module relationships are properly defined.
     */
    public function test_module_has_proper_relationships(): void
    {
        $module = Module::factory()->create();
        $teacher = Teacher::factory()->create();

        // Attach teacher
        $module->teachers()->attach($teacher->id);

        // Create enrollments
        Enrollment::factory()->count(3)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        Enrollment::factory()->count(2)->create([
            'module_id' => $module->id,
            'status' => 'completed',
        ]);

        // Test relationships
        $this->assertCount(1, $module->teachers);
        $this->assertCount(5, $module->enrollments);
        $this->assertCount(3, $module->activeEnrollments);
        $this->assertCount(2, $module->completedEnrollments);
    }

    /**
     * Test module cannot exceed maximum capacity.
     */
    public function test_module_capacity_never_negative(): void
    {
        $module = Module::factory()->create([
            'max_students' => 5,
        ]);

        // Overfill module (edge case)
        Enrollment::factory()->count(7)->create([
            'module_id' => $module->id,
            'status' => 'active',
        ]);

        $module->refresh();

        // Available spots should be 0, not negative
        $this->assertEquals(0, $module->available_spots);
        $this->assertGreaterThanOrEqual(0, $module->available_spots);
    }
}