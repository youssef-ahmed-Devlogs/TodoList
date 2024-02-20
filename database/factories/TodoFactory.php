<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'todo_text' => fake()->text(),
            'category' => fake()->randomElement(['normal', 'personal', 'work']),
            'completed' => fake()->boolean(),
            'user_id' => User::factory(),
        ];
    }
}
