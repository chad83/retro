<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->uuid(),
            'category' => fake()->randomElement(['went well', 'can be improved']),
            'text' => fake()->text(60),
            'is_starred' => fake()->randomElement([0, 0, 0, 1]),
            'likes' => fake()->numberBetween(0, 6)
        ];
    }
}
