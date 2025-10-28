<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;

class FavoritesController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Избранные товары — БРИКС | Кирпич, кровля, тротуарная плитка',
            'Ваш список избранных товаров в БРИКС. Сохраняйте и сравнивайте кирпич, кровлю и тротуарную плитку перед покупкой. Доставка по всей России.',
            'Избранные товары — БРИКС',
            'Просмотрите и управляйте своим списком избранных товаров. Выберите лучший кирпич, кровлю или тротуарную плитку от БРИКС с доставкой по всей России.',
            asset('img/logo.webp'),
            route('favorites'),
            'website',
        );

        return view('favorites')->with('seo', $seo);
    }
}
