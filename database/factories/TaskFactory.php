<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->words(2, true),
            'item_amount' => $this->faker->numberBetween(500, 10000),
            'category' => $this->faker->randomElement(['Food', 'Transport', 'Health', 'Entertainment']),
            'expense_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(), // fallback to factory
        ];
    }
}
