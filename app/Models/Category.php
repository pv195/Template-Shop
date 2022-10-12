<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    public $table = "categories";

    protected $fillable = ['name'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    /**
     * Get the category for the product.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
