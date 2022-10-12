<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\BrandFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

    /**
     * Get the brand for the product.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
