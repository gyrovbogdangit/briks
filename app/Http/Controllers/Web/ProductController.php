<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Helpers\Filter;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
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

        $quickFilters = $subcategory
            ->quickFilters()
            ->with('category', 'subcategory', 'attribute', 'value')
            ->get();

        $seo = new Seo(
            "{$productType->name} — Строительные материалы БРИКС: кирпич, кровля, плитка",
            'Купить ' . mb_strtolower($productType->name) . ' для строительства и отделки от БРИКС. Кирпич, кровля, тротуарная плитка, фасадные материалы с доставкой по всей России.',
            "{$productType->name} — Каталог строительных материалов БРИКС",
            'Ознакомьтесь с ассортиментом БРИКС: ' . mb_strtolower($productType->name) . ', кровля, плитка, фасадные материалы. Большой выбор, выгодные цены, быстрая доставка.',
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
                'seo' => $seo
            ]);
    }

    public function show(ProductType $productType, Category $category, Subcategory $subcategory, Product $product)
    {
        $product = $product->load(
            'category',
            'attributeValues.attribute',
            'attributeValues.value'
        );

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

        $seo = new Seo(
            "{$product->name} — Купить строительные материалы БРИКС",
            "{$product->name} от БРИКС. Качественный кирпич, кровля, плитка и другие строительные материалы с доставкой по России.",
            "{$product->name} — Купить в БРИКС",
            "{$product->name} для строительства и отделки. Закажите онлайн с доставкой по всей России от БРИКС.",
            isset($subcategory->images[0]) ? asset('storage/' . $subcategory->images[0]) : asset('storage/' . $productType->image),
            route('products.show', ['productType' => $productType->slug, 'category' => $category->slug, 'subcategory' => $subcategory->slug, 'product' => $product->slug]),
            'product',
        );

        return view('products.show')
            ->with([
                'type' => $productType,
                'category' => $category,
                'subcategory' => $subcategory,
                'product' => $product,
                'relatedProducts' => $relatedProducts,
                'seo' => $seo
            ]);
    }
}
