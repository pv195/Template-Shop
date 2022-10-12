<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,50),
            'product_id' => rand(1,20),
            'content' => $this->faker->text(rand(100,200)),
            'parent_id' => 0,
        ];
    }
}
