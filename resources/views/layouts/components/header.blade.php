<div class="top-nav py-2">
    <div class="container d-flex justify-content-between align-items-center fw-bolder">
        <div>
            <span class="me-3"><i class="fas fa-map-marker-alt"></i> Ваш город: Москва</span>
            <a href="#">Акции</a>
            <a href="#">Доставка</a>
            <a href="#">Оплата</a>
            <a href="#">Контакты</a>
        </div>
        <div>
            <span class="me-3"><i class="fas fa-phone me-1"></i> +7 (495) 123-45-67</span>
            <span><i class="fas fa-store me-1"></i> ул. 9 Января, 195, Воронеж</span>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">БРИКС</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="offcanvas"
                        data-bs-target="#catalog-menu">Каталог</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="search-wrapper me-4">
                    <input type="text" class="search-input" placeholder="Поиск..." />
                    <i class="fas fa-search search-icon"></i>
                </div>
                <a href="#" class="icon-link"><i class="fas fa-heart"></i></a>
                <a href="#" class="icon-link"><i class="fas fa-chart-simple"></i></a>
                <a href="#" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>
</nav>

{{-- <div style="display: none;" class="modal modal--no-price modal--bottom" id="city">
    <div class="modal-wrap">
        <div class="modal-title"><span>Изменить город</span><button class="modal-close-btn" type="button"
                data-fancybox-close><i class="icon-close1"></i></button></div>
        <livewire:city-search />
    </div>
</div> --}}
