<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => fake()->unique()->userName(),
            'balance' => fake()->randomFloat(2, 0, 10000),
            'daily_limit' => fake()->randomFloat(2, 0, 500),
            'weekly_limit' => fake()->randomFloat(2, 0, 2000),
            'monthly_limit' => fake()->randomFloat(2, 0, 5000),
        ];
    }
}
