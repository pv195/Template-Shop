<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'product_id', 'content', 'parent_id', 'created_at', 'updated_at'];

    /**
     * Get author of comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Format created at.
     */
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M d-Y');
    }
}
