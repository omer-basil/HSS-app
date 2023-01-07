<?php

namespace Database\Factories\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff\Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement(['S', 'M', 'L', 'Xl', 'XXl', '30-94', '32-94']),
            'quantity' => fake()->randomNumber(1,10),
            'colour_id' => fake()->randomNumber(1,10)
        ];
    }
}
