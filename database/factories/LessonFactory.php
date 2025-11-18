<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class LessonFactory extends Factory
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
            'id_user' => User::inRandomOrder()->value('id') ?? User::factory(),
            'id_course' => Course::inRandomOrder()->value('id') ?? Course::factory(),
            'progress' => fake()->numberBetween(0,100),
            'created_at' => fake()->datetime(),
            'deleted_at' => fake()->optional()->dateTime(),
            'updated_at' => fake()->datetime(),
        ];
    }
}
