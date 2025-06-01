<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;
use App\Http\Controllers\Controller;

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
            ->orderBy('name')
            ->withCount('products')
            ->get();

        return view('categories.show', [
            'category' => $category,
            'subcategories' => $subcategories,
        ]);
    }
}
