<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\Randomizer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'collection_id' => fake()->unique()->numberBetween(1, 100),
            'amount' => $randomizer->getFloat(120.0, 150.0)
        ];
    }

    /**
     * Indicate that the payment method should be cash
     */
    public function cash(): static
    {
        return $this->state(fn (array $attributes) => [
            'method_id' => 1
        ]);
    }

    /**
     * Indicate that the payment method should be bank
     */
    public function bank(): static
    {
        return $this->state(fn (array $attributes) => [
            'method_id' => 2
        ]);
    }

    /**
     * Indicate that the payment method should be cash
     */
    public function mobile(): static
    {
        return $this->state(fn (array $attributes) => [
            'method_id' => 3
        ]);
    }
}
