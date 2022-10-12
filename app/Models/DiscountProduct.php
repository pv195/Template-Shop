<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    use HasFactory;

    protected $table = 'discount_product';

    protected $fillable = ['code', 'discount_id', 'product_id', 'rate'];

    /**
     * Get Order
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Get product of discount
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
