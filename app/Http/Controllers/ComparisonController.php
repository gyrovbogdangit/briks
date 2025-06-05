<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;

class ComparisonController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Сравнение товаров — Briks | Кирпич, кровля, тротуарная плитка',
            'Сравните характеристики и цены на кирпич, кровлю и тротуарную плитку от Briks. Выберите лучший товар для ваших нужд с доставкой по всей России.',
            'Сравнение товаров — Briks',
            'Сравните и выберите подходящий кирпич, кровлю или тротуарную плитку от компании Briks. Узнайте ключевые характеристики и преимущества каждого товара.',
            asset('img/logo.svg'),
            route('comparison'),
            'website',
        );

        return view('comparison')->with('seo', $seo);
    }
}
