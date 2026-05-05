<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Review;

class CategoryController extends Controller
{
    public function show(ProductType $productType, Category $category)
    {
        $subcategories = $category
            ->subcategories()
            ->with(['products' => function ($query) {
                $query->active();
                $query->limit(1);
            }])
            ->orderByRaw('ISNULL(sort_index), sort_index')
            ->withCount('products')
            ->get();

        $seo = new \App\Helpers\Seo(
            $category->name . ' в Воронеже — купить по цене от производителя в БРИКС',
            $category->name . " для строительства и отделки от БРИКС. В каталоге БРИКС представлен большой выбор позиций в разделе «{$category->name}». Актуальные цены и наличие в Воронеже.",
            $category->name . ' — Каталог БРИКС',
            'Ознакомьтесь с ассортиментом БРИКС: ' . mb_strtolower($category->name) . ', кровля, плитка, фасадные материалы. Доставка по всей России.',
            isset($category->image) ? asset('storage/' . $category->image) : '',
            route('categories.show', ['productType' => $productType->slug, 'category' => $category->slug]),
            'website',
        );

        $reviews = Review::published()
            ->whereHas('product.subcategory', fn($q) => $q->where('category_id', $category->id))
            ->with('product.subcategory.category.productType')
            ->latest()->limit(6)->get();

        return view('categories.show', [
            'category'      => $category,
            'subcategories' => $subcategories,
            'seo'           => $seo,
            'latestReviews' => $reviews,
        ]);
    }
}
