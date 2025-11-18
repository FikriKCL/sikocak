<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Skill;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExerciseFactory extends Factory
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
            'id_skill' => Skill::inRandomOrder()->value('id') ?? Skill::factory(),
            'question_text' => fake()->word(),
            'difficulty' => fake()->numberBetween(1,5),
            'created_at' => fake()->dateTime('now'),
            'updated_at' => fake()->dateTime('now'),
        ];
    }
}
