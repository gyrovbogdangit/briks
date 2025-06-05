<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'Корзина — Briks | Кирпич, кровля, тротуарная плитка',
            'Просмотрите товары в корзине и оформите заказ на кирпич, кровлю или тротуарную плитку от компании Briks. Доставка по всей России.',
            'Ваша корзина — Briks',
            'Готовы оформить заказ? Просмотрите товары в корзине и завершите покупку кирпича, кровли или тротуарной плитки от Briks.',
            asset('img/logo.svg'),
            route('cart'),
            'website',
        );

        return view('cart')->with('seo', $seo);
    }
}
