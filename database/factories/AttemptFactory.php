<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AttemptFactory extends Factory
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
            'id_user' => User::inRandomOrder()->value('id') ?? User::factory(),
            'score' => fake()->numberBetween(0,100),
            'is_correct' => fake()->numberBetween(0,1),
            'created_at' => fake()->dateTime('now'),
            'updated_at' => fake()->dateTime('now'),
        ];
    }
}
