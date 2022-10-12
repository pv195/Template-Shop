<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 5),
            'status' => '' . rand(0, 4),
            'note' => Str::random(10),
            'fullname' =>  $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => '034' . rand(10000, 90000),
        ];
    }
}
