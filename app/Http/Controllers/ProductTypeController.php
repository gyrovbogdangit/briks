<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\Review;

class ProductTypeController extends Controller
{
    public function show(ProductType $productType)
    {
        $categories = $productType->categories()
            ->orderByRaw('ISNULL(sort_index), sort_index')
            ->with(['subcategories' => function ($query) {
                $query->orderByRaw('ISNULL(sort_index), sort_index');
                $query->withCount('products');
            }])
            ->get();

        $reviews = Review::published()
            ->whereHas('product.subcategory.category', fn($q) => $q->where('product_type_id', $productType->id))
            ->with('product.subcategory.category.productType')
            ->latest()->limit(6)->get();

        $seo = new \App\Helpers\Seo(
            $productType->name . ' в Воронеже — каталог, цены, наличие в БРИКС',
            $productType->name . " для строительства и отделки от БРИКС. {$productType->name} для любых строительных задач. Доставка по Воронежу и области.",
            $productType->name . ' — Каталог БРИКС',
            'Ознакомьтесь с ассортиментом БРИКС: ' . mb_strtolower($productType->name) . ', кровля, плитка, фасадные материалы. Доставка по всей России.',
            isset($productType->image) ? asset('storage/' . $productType->image) : '',
            route('product-types.show', ['productType' => $productType->slug]),
            'website',
        );

        return view('product-types.show', [
            'productType' => $productType,
            'categories'  => $categories,
            'seo'         => $seo,
            'latestReviews' => $reviews,
        ]);
    }
}
