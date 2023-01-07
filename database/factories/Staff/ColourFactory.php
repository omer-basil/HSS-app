<?php

namespace Database\Factories\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff\Colour>
 */
class ColourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->safeColorName(),
            'image' => fake()->imageUrl(480, 480, 'colors'),
        ];
    }
}
