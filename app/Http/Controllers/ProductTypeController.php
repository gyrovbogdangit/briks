<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function show(ProductType $productType)
    {
        $categories = $productType->categories()
            ->with(['subcategories' => function ($query) {
                $query->orderBy('name');
                $query->withCount('products');
            }])
            ->get();

        return view('product-types.show', [
            'productType' => $productType,
            'categories' => $categories,
        ]);
    }
}
