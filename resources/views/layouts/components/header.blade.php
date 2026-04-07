<div class="top-nav py-2 d-none d-xl-block">
    <div class="container d-flex justify-content-between align-items-center ">
        <div class="d-flex gap-2">
            <livewire:city-name />
            <a href="{{ $addresses[0]->url }}" rel="noopener noreferrer" target="_blank" itemprop="address"
                class="text-decoration-none">
                </i> {{ $addresses[0]->address }}
            </a>
        </div>
        <div itemscope itemtype="https://schema.org/Organization" class="gap-4 d-flex">
            <a href="{{ route('reviews.index') }}">Отзывы</a>
            @foreach ($pages as $page)
                <a href="{{ route('page', ['page' => $page]) }}" title="{{ $page->meta_title ?? $page->title }}">
                    {{ $page->title }}
                </a>
            @endforeach
            <meta itemprop="name" content="БРИКС">
            <a href="tel:{{ $phoneNumbers[0]->number }}" itemprop="telephone"
                class="text-decoration-none text-dark fw-semibold">
                {{ $phoneNumbers[0]->number }}
            </a>

        </div>
    </div>
</div>

<nav class="navbar border-bottom border-light-subtle" aria-label="Главное меню">
    <div class="container">
        <div class="d-flex d-xl-none w-100 align-items-center gap-2 py-2">
            <a class="navbar-brand flex-shrink-0 me-2" href="{{ route('home') }}" rel="home">
                <img src="{{ asset('img/logo.webp') }}" width="139" height="36"
                    alt="БРИКС — строительные материалы" aria-label="БРИКС — строительные материалы">
            </a>
            <div class="flex-grow-1 mx-0" role="search">
                <livewire:search />
            </div>
            <button class="btn ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileHeaderMenu"
                aria-label="Toggle navigation" aria-controls="mobileHeaderMenu" aria-expanded="false">
                <i class="fas fa-bars fs-4"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-between d-none d-xl-flex gap-2" id="navbarNav">
            <a class="navbar-brand me-2 flex-shrink-0" href="{{ route('home') }}" rel="home">
                <img src="{{ asset('img/logo.webp') }}" width="139" height="36"
                    alt="БРИКС — строительные материалы" aria-label="БРИКС — строительные материалы">
            </a>

            <a class="btn btn-primary px-4 fw-bold text-nowrap mx-2 mb-2 mb-lg-0" href="#" id="catalog-toggle-btn"
                style="height:48px;padding-top:10px;padding-bottom:8px;border-radius:0.75rem;">
                <i class="fa-solid fa-bars me-2"></i>Каталог
            </a>

            <livewire:search />

            <livewire:header-actions />
            <noscript><a href="{{ route('cart') }}">Корзина</a></noscript>
        </div>
    </div>
</nav>
{{--
<div class="border-bottom border-light-subtle bg-white">
    <nav class="container-xl">
        <ul class="nav flex-nowrap align-items-center fs-7 fw-semibold overflow-x-auto text-nowrap"
            style="gap:2.5rem;list-style:none;padding-top:10px;padding-bottom:10px;">
            @foreach ($types as $type)
                <li class="nav-item">
                    <a class="nav-link p-0 bottom-nav-link transition"
                        href="{{ route('product-types.show', ['productType' => $type]) }}">{{ $type->name }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</div> --}}

<div class="offcanvas offcanvas-end d-xl-none" tabindex="-1" id="mobileHeaderMenu"
    aria-labelledby="mobileHeaderMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileHeaderMenuLabel">Меню</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-3">
            <livewire:city-name />
        </div>

        <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray px-3 text-nowrap w-100 mb-3"
            href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu" aria-controls="catalog-menu"
            aria-expanded="false">
            <i class="fa-solid fa-bars me-2"></i>Каталог
        </a>

        <div class="mb-3">
            <div class="container">
                <livewire:header-actions />
                <noscript><a href="{{ route('cart') }}">Корзина</a></noscript>
            </div>
            <div class="mt-3">
                @foreach ($pages as $page)
                    <a href="{{ route('page', ['page' => $page]) }}"
                        class="d-block bg-light mb-2 text-decoration-none text-center text-secondary py-1"
                        title="{{ $page->meta_title ?? $page->title }}">
                        {{ $page->title }}
                    </a>
                @endforeach
                <a href="{{ route('reviews.index') }}"
                    class="d-block bg-light mb-2 text-decoration-none text-center text-secondary py-1">
                    Отзывы
                </a>
            </div>
        </div>

        <hr />

        <div itemscope itemtype="https://schema.org/Organization">
            <meta itemprop="name" content="БРИКС">
            <div class="mb-2">
                <a href="tel:{{ $phoneNumbers[0]->number }}" class="text-decoration-none link-dark"
                    itemprop="telephone"><i class="fas fa-phone me-1"></i> {{ $phoneNumbers[0]->number }}</a>
            </div>
            <div>
                <a href="{{ $addresses[0]->url }}" class="text-decoration-none link-dark" target="_blank"
                    rel="noopener noreferrer" itemprop="address">
                    <i class="fas fa-shop me-1"></i> {{ $addresses[0]->address }}
                </a>
            </div>
        </div>
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
