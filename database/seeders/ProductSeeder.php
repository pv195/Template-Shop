<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(50)
            ->has(User::factory()->count(2))
            ->has(Category::factory()->count(2))
            ->has(Brand::factory()->count(2))
            ->create();
    }
}
