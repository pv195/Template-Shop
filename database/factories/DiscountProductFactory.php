<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'discount_id' => rand(1, 10),
            'product_id' => rand(1, 10),
            'rate' => $this->faker->numberBetween($min = 1, $max = 50),
        ];
    }
}
