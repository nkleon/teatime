<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\Randomizer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farm>
 */
class FarmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomizer = new Randomizer();
        return [
            'name' => fake()->unique()->company()." Farm",
            'owner_id' => fake()->unique()->numberBetween(1, 6),
            'rate' => $randomizer->getFloat(18.5, 21.5)
        ];
    }

    /**
     * Indicate that the farm is inactive
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false
        ]);
    }
}
