<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderProductFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;


     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => rand(1, 50),
            'product_id' =>  rand(1, 50),
            'quantity' => rand(1,5),
            'discount' => $this->faker->randomFloat(2, 0.05, 0.2),
        ];
    }
}
