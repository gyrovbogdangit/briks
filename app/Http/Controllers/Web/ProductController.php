<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Filter;
use App\Helpers\Seo;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Review;
use App\Models\Subcategory;
use App\Services\RecentlyViewedService;

class ProductController extends Controller
{
    public function index(ProductType $productType, Category $category, Subcategory $subcategory)
    {
        $filter = new Filter($productType, $category, $subcategory, request()->query());

        $categories = $productType
            ->categories()
            ->orderByRaw('ISNULL(sort_index), sort_index')
            ->with(['subcategories' => function ($query) {
                $query->orderByRaw('ISNULL(sort_index), sort_index');
                $query->withCount('products');
            }])->get();

        $attributes = Attribute::getWithValuesAndCounts($filter);

        $products = $subcategory
            ->products()
            ->with('subcategory.category.productType')
            ->active()
            ->filterByAttributes($filter->attributes)
            ->sortBy($filter->sortBy)
            ->showProducts($filter->showProducts);

        $products = $products->paginate($filter->pageSize);

        $latestReviews = Review::published()
                    ->whereHas('product', fn($q) => $q->where('subcategory_id', $subcategory->id))
                    ->with('product.subcategory.category.productType')
                    ->latest()->limit(6)->get();

        $quickFilters = $subcategory
            ->quickFilters()
            ->with('category', 'subcategory', 'attribute', 'value')
            ->get();

        $dynamicSuffix = static::getDynamicSuffix($filter);

        $description = "{$subcategory->name} для строительства и отделки. В каталоге БРИКС: выгодные цены, широкий ассортимент и доставка по Воронежу и области. Узнайте стоимость и наличие на сайте!";
        $seo = new Seo(
            "{$subcategory->name} купить в Воронеже по выгодной цене — каталог строительных материалов БРИКС{$dynamicSuffix}",
            $description,
            "{$subcategory->name} — Каталог строительных материалов БРИКС",
            $description,
            asset('storage/' . $productType->image),
            route('products.index', ['productType' => $productType->slug, 'category' => $category, 'subcategory' => $subcategory]),
            'website',
        );

        return view('products.index')
            ->with([
                'type' => $productType,
                'products' => $products,
                'category' => $category,
                'subcategory' => $subcategory,
                'categories' => $categories,
                'attributes' => $attributes,
                'filter' => $filter,
                'quickFilters' => $quickFilters,
                'seo' => $seo,
                'latestReviews' => $latestReviews,
            ]);
    }

    public function show(ProductType $productType, Category $category, Subcategory $subcategory, Product $product)
    {
        $product = $product->load(
            'category',
            'attributeValues.attribute',
            'attributeValues.value'
        );

        $reviews = $product->reviews()->published()->latest()->get();
        $avgRating = $reviews->avg('rating');
        $ratingStats = $reviews->groupBy('rating')->map->count();
        $starsCount = collect([5, 4, 3, 2, 1])->mapWithKeys(function ($star) use ($ratingStats) {
            return [$star => $ratingStats->get($star, 0)];
        });

        if (!RecentlyViewedService::inProducts($product)) {
            $product->update(['views' => $product->views + 1]);
        }

        RecentlyViewedService::addProduct($product);

        $relatedProducts = $subcategory
            ->products()
            ->active()
            ->with('category')
            ->where('id', '<>', $product->id)
            ->limit(5)
            ->get();

        $description = "{$product->name} в интернет-магазине БРИКС. Актуальные цены, полные характеристики и фото. Доставка по Воронежу и области, товар в наличии. Звоните!";

        $seo = new Seo(
            "{$product->name} купить в Воронеже — цена, характеристики в БРИКС",
            $description,
            "{$product->name} — Купить в БРИКС",
            $description,
            isset($product->images[0]) ? asset('storage/' . $product->images[0]) : asset('storage/' . $productType->image),
            route('products.show', ['productType' => $productType->slug, 'category' => $category->slug, 'subcategory' => $subcategory->slug, 'product' => $product->slug]),
            'product',
        );

        return view('products.show')
            ->with([
                'type' => $productType,
                'category' => $category,
                'subcategory' => $subcategory,
                'product' => $product,
                'reviews' => $reviews,
                'avgRating' => $avgRating,
                'starsCount' => $starsCount,
                'relatedProducts' => $relatedProducts,
                'seo' => $seo
            ]);
    }

    private static function getDynamicSuffix($filter)
    {
        if (empty(request()->query())) {
            return '';
        }

        $sortTitles = [
            'popular' => 'Сортировать по популярности',
            'price' => 'Сортировать по цене',
            'name' => 'Сортировать по названию',
        ];

        $sortPart = $sortTitles[$filter->sortBy] ?? null;
        $pageSizePart = $filter->pageSize ? "Товаров на странице: {$filter->pageSize}" : null;
        $pagePart = request()->query('page') && request()->query('page') > 1 ? 'Страница ' . request()->query('page') : null;

        $dynamicParts = array_filter([$sortPart, $pageSizePart, $pagePart]);
        return $dynamicParts ? ' (' . implode(', ', $dynamicParts) . ')' : '';
    }
}
