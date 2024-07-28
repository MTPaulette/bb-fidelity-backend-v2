<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'by_cash' => fake()->boolean(),
            'bonus_point' => fake()->numberBetween(0, 50000),
            'user_balance' => fake()->numberBetween(0, 150000),
            //'admin_id' => 1
        ];
    }
}
