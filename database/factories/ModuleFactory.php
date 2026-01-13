<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->lexify('???')) . fake()->numerify('###'),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(10),
            'max_students' => fake()->numberBetween(5, 10),
            'is_available' => true,
        ];
    }

    public function unavailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_available' => false,
        ]);
    }

    public function withCapacity(int $capacity): static
    {
        return $this->state(fn (array $attributes) => [
            'max_students' => $capacity,
        ]);
    }
}