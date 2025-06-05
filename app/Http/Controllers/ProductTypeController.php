<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

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

        return view('product-types.show', [
            'productType' => $productType,
            'categories' => $categories,
        ]);
    }
}
