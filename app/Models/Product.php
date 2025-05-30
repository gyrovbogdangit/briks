<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'is_new' => 'boolean',
        'is_hit_of_sales' => 'boolean',
        'is_active' => 'boolean',
        'images' => 'array',
        'docs' => 'array',
        'docs_file_names' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            Subcategory::class,
            'id',
            'id',
            'subcategory_id',
            'category_id'
        );
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function discountPercentage()
    {
        return floor(100 - ($this->discount_price_per_piece / $this->price_per_piece) * 100);
    }

    public function getFormattedPricePerPiece()
    {
        return static::formatPrice($this->price_per_piece);
    }

    public function getFormattedPriceSqm()
    {
        return static::formatPrice($this->price_per_sqm);
    }

    public function getFormattedDiscountPricePerPiece()
    {
        return static::formatPrice($this->discount_price_per_piece);
    }

    public function getFormattedDiscountPriceSqm()
    {
        return static::formatPrice($this->discount_price_per_piece);
    }

    public static function getDocExtension(string $doc)
    {
        return Str::upper(pathinfo($doc, PATHINFO_EXTENSION));
    }

    public static function getDocIcon(string $doc)
    {
        $mimeType = Storage::disk('public')->mimeType($doc);
        $iconMap = [
            'application/pdf' => 'icon-list6',
            'image/jpeg' => 'icon-list1',
            'image/webp' => 'icon-list1',
            'image/png' => 'icon-list1',
            'application/msword' => 'icon-list2',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'icon-list2',
        ];

        return $iconMap[$mimeType] ?? 'icon-list4';
    }

    public static function formatPrice($price, $thousandsSeparator = '&nbsp')
    {
        return number_format($price, 0, ',', $thousandsSeparator);
    }

    public static function scopeWithAttributes($query)
    {
        return $query->with('attributeValues.attribute', 'attributeValues.value');
    }

    public static function scopeWithSubcategory($query)
    {
        return $query->with('subcategory');
    }

    public static function scopeFilterByAttributes($query, $attributes)
    {
        foreach ($attributes as $attribute) {
            $query->whereHas('attributeValues', function ($query) use ($attribute) {
                $name = $attribute->slug;
                $values = $attribute->values->pluck('slug');
                $query
                    ->whereHas('attribute', function ($query) use ($name) {
                        $query->where('slug', $name);
                    })
                    ->whereHas('value', function ($query) use ($values) {
                        $query->whereIn('slug', $values);
                    });
            });
        }
        return $query;
    }

    public static function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'price':
                $query->orderByRaw('IFNULL(discount_price_per_piece, price_per_piece)');
                break;
            case 'category':
                $query->orderBy('name');
                break;
        }
    }

    public static function scopeShowProducts($query, $showProducts)
    {
        switch ($showProducts) {
            case 'all':
                break;
            case 'new':
                $query->where('is_new', 1);
                break;
            case 'hits':
                $query->where('is_hit_of_sales', 1);
                break;
            case 'discounts':
                $query->whereNotNull('discount_price_per_piece')->orWhere('discount_price_per_sqm', '>', 0);
                break;
        }
    }

    public static function scopeFilterByPriceRange($query, $priceRange)
    {
        $query->where(DB::raw('IFNULL(discount_price_per_piece, price_per_piece)'), '>=', $priceRange[0])->where(
            DB::raw('IFNULL(discount_price_per_piece, price_per_piece)'),
            '<=',
            $priceRange[1]
        );
    }

    public static function scopeGetPriceRange($query)
    {
        return $query->select(
            DB::raw(
                'MAX(IFNULL(discount_price_per_piece, price_per_piece)) as max_price, MIN(IFNULL(discount_price_per_piece, price_per_piece)) as min_price',
            )
        )->get();
    }

    public static function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

    public static function scopeFuzzySearch($query, $search)
    {
        return $query
            ->where('products.name', 'like', "%$search%")
            ->orWhereHas('subcategory', function ($query) use ($search) {
                $query->where('subcategories.name', 'like', "%$search%");
            })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('categories.name', 'like', "%$search%");
            })
            ->orWhereHas('category.productType', function ($query) use ($search) {
                $query->where('product_types.name', 'like', "%$search%");
            })
            ->distinct();
    }
}
