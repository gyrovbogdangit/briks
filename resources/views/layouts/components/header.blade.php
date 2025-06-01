<div class="top-nav py-2 d-none d-lg-block">
    <div class="container d-flex justify-content-between align-items-center fw-bolder">
        <div class="d-flex">
            <livewire:city-name />
            @foreach ($pages as $page)
                <a href="{{ route('page', ['page' => $page]) }}">{{ $page->title }}</a>
            @endforeach
        </div>
        <div>
            <span class="me-3"><i class="fas fa-phone me-1"></i> +7 (495) 123-45-67</span>
            <span><i class="fas fa-shop me-1"></i> ул. 9 Января, 195, Воронеж</span>
        </div>
    </div>
</div>

<nav class="navbar border-bottom">
    <div class="container">
        <div class="d-flex d-lg-none w-100 align-items-center gap-2 py-2">
            <a class="navbar-brand flex-shrink-0 me-2" href="{{ route('home') }}">БРИКС</a>
            <div class="flex-grow-1 mx-0" role="search">
                <livewire:search />
            </div>
            <button class="btn ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileHeaderMenu">
                <i class="fas fa-bars fs-4"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-between d-none d-lg-flex" id="navbarNav">
            <a class="navbar-brand me-2 flex-shrink-0" href="{{ route('home') }}">БРИКС</a>
            <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray fw-bold px-3 text-nowrap me-2 mb-2 mb-lg-0"
                href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu"
                style="height:44px;padding-top:8px;">
                <i class="fa-solid fa-bars me-2"></i>Каталог
            </a>

            <livewire:search />

            <div class="d-flex align-items-center gap-3 order-4">
                <div class="icon-item text-center">
                    <a href="{{ route('favorites') }}" class="d-block me-0 text-secondary text-decoration-none">
                        <i class="fas fa-bookmark fs-6"></i>
                        <div class="icon-label mt-0 text-light-emphasis fw-semibold">Избранное</div>
                    </a>
                </div>
                <div class="icon-item text-center border-white">
                    <a href="{{ route('comparison') }}" class="d-block me-0 text-secondary text-decoration-none">
                        <i class="fas fa-chart-simple fs-6"></i>
                        <div class="icon-label mt-0 text-light-emphasis fw-semibold">Сравнение</div>
                    </a>
                </div>
                <div class="icon-item text-center border-white">
                    <a href="{{ route('cart') }}" class="d-block me-0 text-secondary text-decoration-none">
                        <i class="fas fa-shopping-cart fs-6"></i>
                        <div class="icon-label mt-0 text-light-emphasis fw-semibold">Корзина</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileHeaderMenu"
    aria-labelledby="mobileHeaderMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileHeaderMenuLabel">Меню</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-3">
            <livewire:city-name />
        </div>
        <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray fw-bold px-3 text-nowrap w-100 mb-3"
            href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu">
            <i class="fa-solid fa-bars me-2"></i>Каталог
        </a>
        <div class="mb-3">
            <div class="icon-item text-center mb-2">
                <a href="{{ route('favorites') }}" class="d-block text-secondary text-decoration-none">
                    <i class="fas fa-bookmark fs-6"></i>
                    <div class="icon-label mt-0 text-light-emphasis fw-semibold">Избранное</div>
                </a>
            </div>
            <div class="icon-item text-center mb-2">
                <a href="{{ route('comparison') }}" class="d-block text-secondary text-decoration-none">
                    <i class="fas fa-chart-simple fs-6"></i>
                    <div class="icon-label mt-0 text-light-emphasis fw-semibold">Сравнение</div>
                </a>
            </div>
            <div class="icon-item text-center mb-2">
                <a href="{{ route('cart') }}" class="d-block text-secondary text-decoration-none">
                    <i class="fas fa-shopping-cart fs-6"></i>
                    <div class="icon-label mt-0 text-light-emphasis fw-semibold">Корзина</div>
                </a>
            </div>
            <div class="mt-3">
                @foreach ($pages as $page)
                    <a href="{{ route('page', ['page' => $page]) }}"
                        class="d-block bg-light mb-2 text-decoration-none text-center text-secondary py-1">{{ $page->title }}</a>
                @endforeach
            </div>
        </div>
        <hr />
        <div class="mb-2"><i class="fas fa-phone me-1"></i> +7 (495) 123-45-67</div>
        <div><i class="fas fa-shop me-1"></i> ул. 9 Января, 195, Воронеж</div>
    </div>
</div>

<div class="modal fade" id="city" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="cityModalLabel">Изменить город</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body p-0">
                <livewire:city-search />
            </div>
        </div>
    </div>
</div>
