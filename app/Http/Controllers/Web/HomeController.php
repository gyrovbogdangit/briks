<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\HeroSlider;
use App\Models\PhoneNumber;

class HomeController extends Controller
{
    public function index()
    {
        $seo = new Seo(
            'БРИКС Воронеж — кирпич, кровля, тротуарная плитка | Официальный сайт',
            'Компания БРИКС в Воронеже: продажа облицовочного кирпича, кровли и тротуарной плитки. Широкий ассортимент строительных материалов от ведущих производителей. Доставка по городу и области!',
            'БРИКС Воронеж — официальный сайт поставщика стройматериалов',
            'Ищете качественный кирпич или плитку в Воронеже? БРИКС предлагает большой выбор фасадных и кровельных материалов по выгодным ценам. Наличие на складе, быстрая доставка.',
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
            'Каталог строительных материалов в Воронеже — БРИКС: цены и наличие',
            'Полный каталог стройматериалов БРИКС: кирпич, брусчатка, кровельные системы и фасадные решения. Сравнение характеристик, актуальные цены в Воронеже и профессиональная консультация.',
            'Каталог стройматериалов БРИКС — купить в Воронеже',
            'Ознакомьтесь с ассортиментом БРИКС: от сталинградского кирпича до плитки Зенит. Все для строительства и отделки в одном каталоге с доставкой по Воронежской области.',
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
            'Политика ООО «Брикс» в отношении обработки и защиты персональных данных пользователей сайта.',
            'Политика конфиденциальности — ООО «Брикс»',
            'Порядок обработки персональных данных, cookies, Яндекс Метрика, права субъектов и контакты Оператора.',
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
