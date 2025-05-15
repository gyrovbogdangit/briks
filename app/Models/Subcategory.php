<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productType()
    {
        return $this->hasOneThrough(
            ProductType::class,
            Category::class,
            'id',
            'id',
            'category_id',
            'product_type_id'
        );
    }

    public function quickFilters()
    {
        return $this->hasMany(QuickFilter::class);
    }
}
