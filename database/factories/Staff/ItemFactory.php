<?php

namespace Database\Factories\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'i_code' => fake()->ean8(),
            'i_name' => fake()->word(),
            'i_price' => fake()->numberBetween(10,99),
            'description' => fake()->paragraph(3),
            'model' => fake()->date(),
            'category_id' => fake()->numberBetween(1,5),
            'brand_id' => fake()->numberBetween(1,5)
        ];
    }
}