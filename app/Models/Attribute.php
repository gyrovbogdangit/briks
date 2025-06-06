<?php

namespace App\Models;

use App\Helpers\Filter;
use App\Models\Value;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_values');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_category');
    }

    public static function scopeWithUniqueValues($query, Filter $filter)
    {
        $attributes = $query->with(['values' => function ($query) use ($filter) {
            $query->orderBy('value')->distinct();
            $query->whereHas('products', function ($query) use ($filter) {
                $query->where('products.subcategory_id', $filter->subcategory->id);
            });
        }])->get();

        foreach ($attributes as $attribute) {
            $attribute->values = $attribute->values->sortBy('value');
            /*
                Код ниже нужен для функции выбора нескольких значений у одного атрибута.
                Например: пользователь выбрал страну Россия,
                    в выборе фильтров мы должны дать возможность выбрать ему другую страну(Китай) и корректно отобразить
                    кол-во для России и для Китая.
            */
            $attribute->values->loadCount(['products' => function ($productQuery) use ($filter, $attribute) {
                $productQuery->active();
                $productQuery->withSubcategory($filter->subcategory);
                $productQuery->where('products.subcategory_id', $filter->subcategory->id);
                if ($filter->priceRange) {
                    $productQuery->filterByPriceRange($filter->priceRange);
                }

                if (in_array($attribute->id, $filter->attributes->pluck('id')->toArray())) {
                    foreach ($filter->attributes as $filterAttribute) {
                        if ($filterAttribute->id == $attribute->id) {
                            $productQuery->whereHas('attributeValues', function ($query) use ($filterAttribute) {
                                $name = $filterAttribute->slug;
                                $values = $filterAttribute->values->pluck('slug');
                                $query
                                    ->whereHas('attribute', function ($query) use ($name) {
                                        $query->where('slug', $name);
                                    })
                                    ->orWhereHas('value', function ($query) use ($values) {
                                        $query->whereIn('slug', $values);
                                    });
                            });
                        } else {
                            $productQuery->whereHas('attributeValues', function ($query) use ($filterAttribute) {
                                $name = $filterAttribute->slug;
                                $values = $filterAttribute->values->pluck('slug');
                                $query
                                    ->whereHas('attribute', function ($query) use ($name) {
                                        $query->where('slug', $name);
                                    })
                                    ->whereHas('value', function ($query) use ($values) {
                                        $query->whereIn('slug', $values);
                                    });
                            });
                        }
                    }
                } else {
                    $productQuery->filterByAttributes($filter->attributes);
                }
            }]);
        }
        return $attributes;
    }

    public function scopeWithAttributesValuesFromQuery($query, array $requestQuery)
    {
        return  $query->withWhereHas(
            'values',
            function ($query) use ($requestQuery) {
                $query->where(function ($query) use ($requestQuery) {
                    foreach ($requestQuery as $name => $values) {
                        if (!is_array($values)) {
                            continue;
                        }

                        $query->orWhere(function ($query) use ($name, $values) {
                            $query->whereHas('attribute', function ($query) use ($name) {
                                $query->where('slug', $name);
                            })->whereIn('slug', $values);
                        });
                    }
                });
            }
        );
    }
}
