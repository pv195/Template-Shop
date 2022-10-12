<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'from', 'to', 'status'];

    /**
     * Get products of discount
     */
    public function discountProducts()
    {
        return $this->hasMany(DiscountProduct::class);
    }

    /**
     * Format from .
     */
    public function getFromLabelAttribute()
    {
        return \Carbon\Carbon::parse($this->from)->format('d-m-Y');
    }

    /**
     * Format to .
     */
    public function getToLabelAttribute()
    {
        return \Carbon\Carbon::parse($this->to)->format('d-m-Y');
    }
}
