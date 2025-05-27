@extends('layouts.master')

@section('content')
    <section id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Слайд 1 -->
            <div class="carousel-item active">
                <div class="hero-banner d-flex align-items-center justify-content-center text-center"
                    style="
              background: url('https://placehold.co/1900x500') center/cover
                no-repeat;
              height: 500px;
              position: relative;
            ">
                    <div class="hero-text text-white">
                        <h1 class="fw-bold">Облицовочные материалы от БРИКС</h1>
                        <p class="fw-semibold">
                            Качество. Надёжность. Прямо от производителя
                        </p>
                        <a href="#" class="btn btn-primary btn-lg mt-3 fw-semibold">Оформить заказ</a>
                    </div>
                </div>
            </div>

            <!-- Слайд 2 -->
            <div class="carousel-item">
                <div class="hero-banner d-flex align-items-center justify-content-center text-center"
                    style="
              background: url('https://placehold.co/1900x500') center/cover
                no-repeat;
              height: 500px;
              position: relative;
            ">
                    <div class="hero-text text-white">
                        <h1 class="fw-bold">Керамическая черепица для вашего дома</h1>
                        <p class="fw-semibold">
                            Эстетика. Долговечность. Проверенное качество
                        </p>
                        <a href="#" class="btn btn-primary btn-lg mt-3 fw-semibold">Оформить заказ</a>
                    </div>
                </div>
            </div>

            <!-- Слайд 3 -->
            <div class="carousel-item">
                <div class="hero-banner d-flex align-items-center justify-content-center text-center"
                    style="
              background: url('https://placehold.co/1900x500') center/cover
                no-repeat;
              height: 500px;
              position: relative;
            ">
                    <div class="hero-text text-white">
                        <h1 class="fw-bold">Надёжный металлопрофиль от БРИКС</h1>
                        <p class="fw-semibold">Идеальное решение для кровли и фасадов</p>
                        <a href="#" class="btn btn-primary btn-lg mt-3 fw-semibold">Оформить заказ</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Стрелки навигации -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title mb-4 text-primary">Акции</h2>

            <div class="overflow-auto">
                <div class="d-flex flex-nowrap gap-4 mt-1">
                    @foreach (range(0, 6) as $i)
                        <div class="product-card" style="min-width: 250px">
                            <img src="https://placehold.co/600x400" alt="Кирпич" />
                            <div class="card-body">
                                <h5 class="card-title text-primary">Кирпич облицовочный</h5>
                                <p class="card-text">Формат: 250х65х65 мм</p>
                                <div class="price-wrapper">
                                    <span class="old-price">50 ₽/шт</span>
                                    <span class="new-price">35 ₽/шт</span>
                                </div>
                                <div class="price-wrapper">
                                    <span class="old-price">1000 ₽/м²</span>
                                    <span class="new-price">900 ₽/м²</span>
                                </div>
                                <div class="action-icons">
                                    <i class="fas fa-cart-plus icon" title="В корзину"></i>
                                    <i class="fas fa-chart-simple icon" title="В сравнение"></i>
                                    <i class="fas fa-heart icon favorite" title="В избранное"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title mb-4 text-primary">Популярное</h2>

            <div class="overflow-auto">
                <div class="d-flex flex-nowrap gap-4 mt-1">
                    @foreach (range(0, 6) as $i)
                        <div class="product-card" style="min-width: 250px">
                            <img src="https://placehold.co/600x400" alt="Кирпич" />
                            <div class="card-body">
                                <h5 class="card-title text-primary">Кирпич облицовочный</h5>
                                <p class="card-text">Формат: 250х65х65 мм</p>
                                <div class="price-wrapper">
                                    <span class="old-price">50 ₽/шт</span>
                                    <span class="new-price">35 ₽/шт</span>
                                </div>
                                <div class="price-wrapper">
                                    <span class="old-price">1000 ₽/м²</span>
                                    <span class="new-price">900 ₽/м²</span>
                                </div>
                                <div class="action-icons">
                                    <i class="fas fa-cart-plus icon" title="В корзину"></i>
                                    <i class="fas fa-chart-simple icon" title="В сравнение"></i>
                                    <i class="fas fa-heart icon favorite" title="В избранное"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title mb-4 text-primary">Новинки</h2>

            <div class="overflow-auto">
                <div class="d-flex flex-nowrap gap-4 mt-1">
                    @foreach (range(0, 6) as $i)
                        <div class="product-card" style="min-width: 250px">
                            <img src="https://placehold.co/600x400" alt="Кирпич" />
                            <div class="card-body">
                                <h5 class="card-title text-primary">Кирпич облицовочный</h5>
                                <p class="card-text">Формат: 250х65х65 мм</p>
                                <div class="price-wrapper">
                                    <span class="old-price">50 ₽/шт</span>
                                    <span class="new-price">35 ₽/шт</span>
                                </div>
                                <div class="price-wrapper">
                                    <span class="old-price">1000 ₽/м²</span>
                                    <span class="new-price">900 ₽/м²</span>
                                </div>
                                <div class="action-icons">
                                    <i class="fas fa-cart-plus icon" title="В корзину"></i>
                                    <i class="fas fa-chart-simple icon" title="В сравнение"></i>
                                    <i class="fas fa-heart icon favorite" title="В избранное"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="bg-light py-5">
        <div class="container">
            <h2 class="section-title mb-5">Почему выбирают БРИКС</h2>
            <div class="row text-center features g-4">

                <div class="col-md-4">
                    <i class="fas fa-industry mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Собственное производство</h5>
                    <p class="text-muted">
                        Контролируем весь цикл — от сырья до готовой продукции. Качество, проверенное временем.
                    </p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-truck-moving mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Быстрая доставка</h5>
                    <p class="text-muted">
                        Оперативная доставка по всей России благодаря собственному автопарку и надёжной логистике.
                    </p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-certificate mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Промышленный стандарт</h5>
                    <p class="text-muted">
                        Вся продукция сертифицирована и соответствует современным строительным стандартам.
                    </p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-piggy-bank mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Выгодные условия</h5>
                    <p class="text-muted">
                        Гибкая система скидок, акции и бесплатное хранение материалов для наших клиентов.
                    </p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-paint-roller mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Широкий ассортимент</h5>
                    <p class="text-muted">
                        Кирпич, черепица, металлопрофиль, штукатурки — более 500 наименований в наличии.
                    </p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-users mb-3 text-primary fs-1"></i>
                    <h5 class="fw-bold mb-2">Индивидуальный подход</h5>
                    <p class="text-muted">
                        Персональный менеджер поможет подобрать материалы, рассчитать стоимость и оформить заказ.
                    </p>
                </div>

            </div>
        </div>
    </div>


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
