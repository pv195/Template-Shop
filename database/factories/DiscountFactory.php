<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
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
            'from' => $this->faker->dateTime($max = 'now', $timezone = null),
            'to' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => '0',
        ];
    }
}
