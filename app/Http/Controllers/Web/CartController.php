<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Корзина — БРИКС | Кирпич, кровля, тротуарная плитка',
            'Просмотрите товары в корзине и оформите заказ на кирпич, кровлю или тротуарную плитку от компании БРИКС. Доставка по всей России.',
            'Ваша корзина — БРИКС',
            'Готовы оформить заказ? Просмотрите товары в корзине и завершите покупку кирпича, кровли или тротуарной плитки от БРИКС.',
            asset('img/logo.webp'),
            route('cart'),
            'website',
        );

        return view('cart')->with('seo', $seo);
    }
}
