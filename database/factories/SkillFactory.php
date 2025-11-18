<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Course;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SkillFactory extends Factory
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
            'id_course' => Course::inRandomOrder()->value('id') ?? Course::factory(),
            'name' => fake()->word(),
            'description' => fake()->word(),
            'created_at' => fake()->datetime('now'),
            'updated_at' => fake()->datetime('now'),
        ];
    }
}
