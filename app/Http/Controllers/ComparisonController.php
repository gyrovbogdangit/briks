<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;

class ComparisonController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Сравнение товаров — БРИКС | Кирпич, кровля, тротуарная плитка',
            'Сравните характеристики и цены на кирпич, кровлю и тротуарную плитку от БРИКС. Выберите лучший товар для ваших нужд с доставкой по всей России.',
            'Сравнение товаров — БРИКС',
            'Сравните и выберите подходящий кирпич, кровлю или тротуарную плитку от компании БРИКС. Узнайте ключевые характеристики и преимущества каждого товара.',
            asset('img/logo.webp'),
            route('comparison'),
            'website',
        );

        return view('comparison')->with('seo', $seo);
    }
}
