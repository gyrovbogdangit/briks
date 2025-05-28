<?php

namespace App\Http\Controllers;

use App\Helper\Seo;

class FavoritesController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Избранные товары — Briks | Кирпич, кровля, тротуарная плитка',
            'Ваш список избранных товаров в Briks. Сохраняйте и сравнивайте кирпич, кровлю и тротуарную плитку перед покупкой. Доставка по всей России.',
            'Избранные товары — Briks',
            'Просмотрите и управляйте своим списком избранных товаров. Выберите лучший кирпич, кровлю или тротуарную плитку от Briks с доставкой по всей России.',
            asset('img/logo.svg'),
            route('favorites'),
            'website',
        );

        return view('favorites')->with('seo', $seo);
    }
}
