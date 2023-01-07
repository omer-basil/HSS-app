<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_code' => fake()->ean8(),
            'item_colour' => fake()->safeColorName(),
            'item_size' => fake()->randomElement(['S', 'M', 'L', 'Xl', 'XXl', '30-94', '32-94']),
            'item_quantity' => fake()->randomNumber(2),
            'item_price' => fake()->numberBetween(5,99),
            'item_link' -> fake()->url()
        ];
    }
}
