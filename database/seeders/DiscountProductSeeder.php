<?php

namespace Database\Seeders;

use App\Models\DiscountProduct;
use Illuminate\Database\Seeder;

class DiscountProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscountProduct::factory()
            ->count(10)
            ->create();
    }
}
