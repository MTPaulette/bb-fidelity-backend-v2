<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(3),
            'price' => fake()->numberBetween(1000, 50000),
            'credit' => fake()->numberBetween(0, 15),
            'debit' => fake()->numberBetween(0, 15),
            'validity' => fake()->randomElement(['1 hour', '1 week', '1 month']),
            'description' => fake()->paragraph(20)
        ];
    }
}
