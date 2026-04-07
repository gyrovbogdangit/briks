<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id', 'name', 'email', 'phone', 'rating', 'body', 'is_published'];

    protected $casts = ['is_published' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
