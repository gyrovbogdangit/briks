<?php

namespace App\Http\Controllers\Web;

use App\Helper\Seo;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\PhoneNumber;

class HomeController extends Controller
{
    public function index()
    {
        $hotProducts = Product::where('is_hit_of_sales', true)->limit(20)->get();

        $seo = new Seo(
            'Briks — Кирпич, кровля, тротуарная плитка и строительные материалы с доставкой',
            'Briks — строительные решения: продажа облицовочного кирпича, кровли, тротуарной плитки, фасадных и кровельных материалов. Большой выбор, выгодные цены, доставка по всей России.',
            'Briks — строительные материалы: кирпич, кровля, плитка',
            'Briks — ваш надежный поставщик кирпича, кровли, тротуарной плитки и других строительных материалов. Оформите заказ онлайн с доставкой по России.',
            asset('img/logo.svg'),
            route('home'),
            'website',
        );

        return view('index')->with(['hotProducts' => $hotProducts, 'seo' => $seo]);
    }

    public function catalog()
    {
        $seo = new Seo(
            'Каталог строительных материалов — Briks | Кирпич, кровля, плитка',
            'Каталог Briks: облицовочный кирпич, кровля, тротуарная плитка, фасадные материалы, аксессуары. Строительные решения для дома и бизнеса. Доставка по всей России.',
            'Каталог строительных материалов — Briks',
            'Ознакомьтесь с каталогом Briks: кирпич, кровля, плитка, фасадные материалы и многое другое. Большой выбор и быстрая доставка.',
            asset('img/logo.svg'),
            route('catalog'),
            'website',
        );

        return view('catalog')->with('seo', $seo);
    }

    public function privacy()
    {
        $seo = new Seo(
            'Политика конфиденциальности | Briks',
            'Узнайте, как мы обрабатываем и защищаем ваши персональные данные на сайте briks.ru',
            'Защита персональных данных на сайте — Briks',
            'Полная информация о целях, условиях хранения и передачи данных на сайте Briks.',
            asset('img/logo.svg'),
            route('privacy'),
            'website',
        );

        $phoneNumber = PhoneNumber::first();
        $email = Email::first();

        return view('privacy')->with([
            'seo' => $seo,
            'phoneNumber' => $phoneNumber,
            'email' => $email
        ]);
    }

    public function search()
    {
        $seo = new Seo(
            'Поиск по сайту Briks — Найдите кирпич, кровлю, плитку',
            'Ищете строительные материалы? Используйте поиск по сайту Briks, чтобы быстро найти нужный кирпич, кровлю, тротуарную плитку и другие товары.',
            'Поиск по сайту — Briks',
            'Найдите нужные строительные материалы с помощью поиска по сайту Briks. Большой ассортимент и доставка по всей России.',
            asset('img/logo.svg'),
            route('search'),
            'website',
        );

        return view('search')->with([
            'seo' => $seo,
        ]);
    }
}
