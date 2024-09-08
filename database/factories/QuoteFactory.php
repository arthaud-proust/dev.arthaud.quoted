<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->name,
            'content' => $this->faker->sentence,
            'validated' => $this->faker->boolean,
            'views' => $this->faker->numberBetween(0, 10000),
            'daily_count' => $this->faker->numberBetween(0, 5),
            'user_id' => User::factory(),
        ];
    }
}
