<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\HeroSlider;
use App\Models\PhoneNumber;

class HomeController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'БРИКС — Кирпич, кровля, тротуарная плитка и строительные материалы с доставкой',
            'БРИКС — строительные решения: продажа облицовочного кирпича, кровли, тротуарной плитки, фасадных и кровельных материалов. Большой выбор, выгодные цены, доставка по всей России.',
            'БРИКС — строительные материалы: кирпич, кровля, плитка',
            'БРИКС — ваш надежный поставщик кирпича, кровли, тротуарной плитки и других строительных материалов. Оформите заказ онлайн с доставкой по России.',
            asset('img/logo.webp'),
            route('home'),
            'website',
        );

        $heroSliders = HeroSlider::orderByRaw('ISNULL(sort_index), sort_index')->get();

        return view('index')
            ->with('seo', $seo)
            ->with('heroSliders', $heroSliders);
    }

    public function catalog()
    {
        $seo = new Seo(
            'Каталог строительных материалов — БРИКС | Кирпич, кровля, плитка',
            'Каталог БРИКС: облицовочный кирпич, кровля, тротуарная плитка, фасадные материалы, аксессуары. Строительные решения для дома и бизнеса. Доставка по всей России.',
            'Каталог строительных материалов — БРИКС',
            'Ознакомьтесь с каталогом БРИКС: кирпич, кровля, плитка, фасадные материалы и многое другое. Большой выбор и быстрая доставка.',
            asset('img/logo.webp'),
            route('catalog'),
            'website',
        );

        return view('catalog')->with('seo', $seo);
    }

    public function privacy()
    {
        $seo = new Seo(
            'Политика конфиденциальности | БРИКС',
            'Узнайте, как мы обрабатываем и защищаем ваши персональные данные на сайте briks.ru',
            'Защита персональных данных на сайте — БРИКС',
            'Полная информация о целях, условиях хранения и передачи данных на сайте БРИКС.',
            asset('img/logo.webp'),
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
            'Поиск по сайту БРИКС — Найдите кирпич, кровлю, плитку',
            'Ищете строительные материалы? Используйте поиск по сайту БРИКС, чтобы быстро найти нужный кирпич, кровлю, тротуарную плитку и другие товары.',
            'Поиск по сайту — БРИКС',
            'Найдите нужные строительные материалы с помощью поиска по сайту БРИКС. Большой ассортимент и доставка по всей России.',
            asset('img/logo.webp'),
            route('search'),
            'website',
        );

        return view('search')->with([
            'seo' => $seo,
        ]);
    }
}
