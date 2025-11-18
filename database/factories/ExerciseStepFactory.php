<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Exercise;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExerciseStepFactory extends Factory
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
            'id_exercise' => Exercise::inRandomOrder()->value('id') ?? Exercise::factory(),
            'step_number' => fake()->numberBetween(1,7),
            'content' => fake()->word(),
            'answer' => fake()->word(),
            'created_at' => fake()->dateTime('now'),
            'updated_at' => fake()->dateTime('now'),
        ];
    }
}
