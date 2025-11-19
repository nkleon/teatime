<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make(env('DEFAULT_USER_PASSWORD', 'password')),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the role should be that of a owner
     */
    public function owner(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => 2
        ]);
    }

    /**
     * Indicate that the role should be that of a tea picker
     */
    public function picker(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => 3
        ]);
    }

    /**
     * Indicate that the user is inactive
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false
        ]);
    }
}
