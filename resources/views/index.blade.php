@extends('layouts.master')

@section('content')
    @include('components.hero')

    <section class="py-5 bg-light">
        @include('components.products-slider', [
            'title' => 'Хит продаж',
            'products' => $hotProducts,
            'key' => 'hotProducts',
        ])
    </section>

    <section class="py-5 bg-white">
        @include('components.products-slider', [
            'title' => 'Популярные товары',
            'products' => $popularProducts,
            'key' => 'popularProducts',
        ])
    </section>

    <section class="py-5 bg-light">
        @include('components.products-slider', [
            'title' => 'Новинки',
            'products' => $newProducts,
            'key' => 'newProducts',
        ])
    </section>

    <section class="py-5 bg-white">
        @include('components.why-choose-us')
    </section>

    {{--   <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title mb-5 text-primary">Наши услуги</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="shadow rounded-4 h-100 overflow-hidden bg-white d-flex flex-column">
                        <div class="service-img"
                            style="height: 180px; background: url('https://placehold.co/600x400') center/cover no-repeat;">
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <h5 class="fw-bold mb-3 text-primary">Бесплатное хранение</h5>
                            <p class="fw-semibold text-muted">
                                Бесплатно сохраним ваши товары на складе БРИКС в течение 2 недель. Забирайте, когда удобно.
                            </p>
                            <a href="#"
                                class="text-decoration-none fw-bold mt-auto text-primary">Подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="shadow rounded-4 h-100 overflow-hidden bg-white d-flex flex-column">
                        <div class="service-img"
                            style="height: 180px; background: url('https://placehold.co/600x400') center/cover no-repeat;">
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <h5 class="fw-bold mb-3 text-primary">Колеровка</h5>
                            <p class="fw-semibold text-muted">
                                Колеруем штукатурку и краску в любой оттенок под ваш проект.
                            </p>
                            <a href="#"
                                class="text-decoration-none fw-bold mt-auto text-primary">Подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="shadow rounded-4 h-100 overflow-hidden bg-white d-flex flex-column">
                        <div class="service-img"
                            style="height: 180px; background: url('https://placehold.co/600x400') center/cover no-repeat;">
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <h5 class="fw-bold mb-3 text-primary">Онлайн-тур</h5>
                            <p class="fw-semibold text-muted">
                                Проведем видеотур по нашему шоуруму БРИКС — не выходя из дома.
                            </p>
                            <a href="#"
                                class="text-decoration-none fw-bold mt-auto text-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
