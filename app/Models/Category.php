<?php

namespace App\Models;

use App\Helpers\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }
}
