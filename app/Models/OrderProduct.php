<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';

    protected $fillable = ['order_id', 'product_id', 'quantity', 'discount'];

    /**
     * Get Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get product of order
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
