<div class="top-nav py-2 d-none d-xl-block">
    <div class="container d-flex justify-content-between align-items-center fw-bolder">
        <div class="d-flex">
            <livewire:city-name />
            @foreach ($pages as $page)
                <a href="{{ route('page', ['page' => $page]) }}">{{ $page->title }}</a>
            @endforeach
        </div>
        <div>
            <a href="tel:{{ $phoneNumbers[0]->number }}">
                <span class="me-3"><i class="fas fa-phone me-1"></i> {{ $phoneNumbers[0]->number }}</span></a>
            <a href="{{ $addresses[0]->url }}" rel="noopener noreferrer" target="_blank">
                <span><i class="fas fa-shop me-1"></i> {{ $addresses[0]->address }}</span></a>
        </div>
    </div>
</div>

<nav class="navbar border-bottom">
    <div class="container">
        <div class="d-flex d-xl-none w-100 align-items-center gap-2 py-2">
            <a class="navbar-brand flex-shrink-0 me-2" href="{{ route('home') }}"><img
                    src="{{ asset('img/logo.webp') }}" width="139" height="36" alt="БРИКС"
                    aria-label="БРИКС"></a>
            <div class="flex-grow-1 mx-0" role="search">
                <livewire:search />
            </div>
            <button class="btn ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileHeaderMenu"
                aria-label="Toggle navigation">
                <i class="fas fa-bars fs-4"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-between d-none d-xl-flex" id="navbarNav">
            <a class="navbar-brand me-2 flex-shrink-0" href="{{ route('home') }}"><img
                    src="{{ asset('img/logo.webp') }}" width="139" height="36" alt="БРИКС"
                    aria-label="БРИКС"></a>
            <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray fw-bold px-3 text-nowrap mx-2 mb-2 mb-lg-0"
                href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu"
                style="height:44px;padding-top:8px;">
                <i class="fa-solid fa-bars me-2"></i>Каталог
            </a>

            <livewire:search />

            <livewire:header-actions />
        </div>
    </div>
</nav>

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
        <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray fw-bold px-3 text-nowrap w-100 mb-3"
            href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu">
            <i class="fa-solid fa-bars me-2"></i>Каталог
        </a>
        <div class="mb-3">
            <div class="container">
                <livewire:header-actions />
            </div>
            <div class="mt-3">
                @foreach ($pages as $page)
                    <a href="{{ route('page', ['page' => $page]) }}"
                        class="d-block bg-light mb-2 text-decoration-none text-center text-secondary py-1">{{ $page->title }}</a>
                @endforeach
            </div>
        </div>
        <hr />
        <div class="mb-2"><a href="tel:{{ $phoneNumbers[0]->number }}" class="text-decoration-none link-dark"><i
                    class="fas fa-phone me-1"></i>
                {{ $phoneNumbers[0]->number }}</a></div>
        <div><a href="{{ $addresses[0]->url }}" class="text-decoration-none link-dark"><i class="fas fa-shop me-1"></i>
                {{ $addresses[0]->address }}</a></div>
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
