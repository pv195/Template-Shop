<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(1, 5, 1000),
            'user_id' => rand(1, 30),
            'category_id' => rand(1, 5),
            'brand_id' => rand(1, 5),
            'image' => "[" . '"' . $this->faker->image('storage/app/public/products', 140, 180, null, false) . '"' . "," . '"' . $this->faker->image('storage/app/public/products', 140, 180, null, false) . '"' . "]",
            'description' => $this->faker->realText($this->faker->numberBetween(100, 300)),
            'quantity' => rand(1, 100),
        ];
    }
}
