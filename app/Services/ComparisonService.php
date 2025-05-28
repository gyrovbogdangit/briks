<?php

namespace App\Services;

use App\Models\ProductType;
use App\Models\Subcategory;

class ComparisonService
{
    public static function add($productId)
    {
        if (in_array($productId, session('comparison', []))) {
            return false;
        }

        session()->push('comparison', $productId);
        return true;
    }

    public static function getSubcategories()
    {
        $sessionComparison = session('comparison');

        if (empty($sessionComparison)) {
            return collect();
        }

        $subcategories = Subcategory::withWhereHas('products', function ($query) use ($sessionComparison) {
            $query->whereIn('id', $sessionComparison)->with('attributeValues.attribute', 'attributeValues.value');
        })
            ->with('attributes', 'category.productType')
            ->get();

        return $subcategories;
    }

    public static function inComparison($productId)
    {
        return in_array($productId, session('comparison', []));
    }

    public static function getTotalQuantity()
    {
        return count(session('comparison', []));
    }

    public static function delete($productId)
    {
        $sessionComparison = session('comparison', []);
        if (empty($sessionComparison)) {
            return false;
        }

        $productIndex = array_search($productId, $sessionComparison);

        if ($productIndex === false) {
            return false;
        }

        session()->pull('comparison.' . $productIndex);
        return true;
    }

    public static function getCategories()
    {
        $sessionComparison = session('comparison');
        if (empty($sessionComparison)) {
            return collect();
        }
        // Получаем все категории, в которых есть сравниваемые товары
        $products = \App\Models\Product::whereIn('id', $sessionComparison)
            ->with(['category', 'attributeValues.attribute', 'attributeValues.value', 'subcategory'])
            ->get();
        $categories = $products->groupBy(function ($product) {
            return $product->category->id;
        })->map(function ($products) {
            $category = $products->first()->category;
            $category->products = $products;
            // Получаем все уникальные атрибуты этой категории
            $category->attributes = $category->attributes()->get();
            return $category;
        });
        return $categories->values();
    }
}
