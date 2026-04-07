<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::published()
            ->with('product.subcategory.category.productType')
            ->latest()
            ->paginate(20);

        $page = request('page');

        $dynamicSuffix = '';

        if (isset($page) && $page != 1) {
            $dynamicSuffix = " - Страница {$page}";
        }

        $seo = new Seo(
            "Отзывы покупателей о строительных материалах БРИКС — Кирпич, кровля, плитка{$dynamicSuffix}",
            "Читайте реальные отзывы клиентов о качестве кирпича, тротуарной плитки и кровельных материалов в компании БРИКС. Узнайте мнение строителей и частных лиц о наших товарах перед покупкой.",
            "Что говорят о материалах БРИКС? Честные отзывы наших клиентов",
            "Реальный опыт использования строительных материалов: от облицовочного кирпича до мягкой кровли. Посмотрите оценки и фотографии покупателей на сайте БРИКС.",
            asset('storage/logo-reviews.jpg'),
            route('reviews.index'),
            'website'
        );

        return view('reviews.index', ['reviews' => $reviews, 'seo' => $seo]);
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'phone'  => 'required|string|max:50',
            'rating' => 'required|integer|min:1|max:5',
            'body'   => 'required|string|max:3000',
        ]);

        $data['product_id'] = $product->id;
        Review::create($data);

        return back()->with('review_sent', true);
    }
}
