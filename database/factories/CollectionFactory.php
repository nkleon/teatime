<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\Randomizer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
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
            'date' => fake()->date(),
            'farm_id' => rand(1, 6),
            'picker_id' => rand(11, 50),
            'quantity' => $randomizer->getFloat(9.0, 11.0)
        ];
    }
}
