<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Lesson;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Learning>
 */
class ProgressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->value('id') ?? User::factory(),
            'id_lesson' => Lesson::inRandomOrder()->value('id') ?? Lesson::factory(),
            'started_at' => fake()->dateTimeBetween('-7 days', 'now'),
            'completed_at' => fake()->dateTimeBetween('now', '+1 hour'),
            'score'=> fake()->numberBetween(1,100),
            'created_at' => fake()->dateTime('now'),
            'updated_at' => fake()->dateTime('now'), 
        ];
    }
}
