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
            'user_id' => User::factory(),
        ];
    }

    public function notValidated(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'validated' => false,
            ];
        });
    }

    public function validated(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'validated' => true,
            ];
        });
    }
}
