<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'status', 'note', 'fullname', 'address', 'phone'];

    /**
     * Get status name
     *
     * @return void
     */
    public function getStatusLabelAttribute()
    {
        return [
            '0' => 'Pending',
            '1' => 'Confirmed',
            '2' => 'Delivering',
            '3' => 'Delivered',
            '4' => 'Cancelled',
        ][$this->status];
    }

    /**
     * Format created at.
     */
    public function getCreatedAtLabelAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d-m-Y H:i:s');
    }

    /**
     * Get user of order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get products of order
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
