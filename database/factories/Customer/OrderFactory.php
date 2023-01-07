<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_code' => fake()->ean8(),
            'total_items' => fake()->randomDigit(),
            'total_price' => fake()->numberBetween(10,99),
            'delivered' => fake()->boolean(50),
            'payment_confirmation' => fake()->boolean(50),
            'user_id' => fake()-numberBetween(1,5)
        ];
    }
}
