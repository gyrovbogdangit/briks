<div class="top-nav py-2">
    <div class="container d-flex justify-content-between align-items-center fw-bolder">
        <div class="d-flex">
            <div class="me-3"><i class="fas fa-map-marker-alt"></i> Ваш город: Москва</div>
            <a href="#">Акции</a>
            <a href="#">Доставка</a>
            <a href="#">Оплата</a>
            <a href="#">Контакты</a>
        </div>
        <div>
            <span class="me-3"><i class="fas fa-phone me-1"></i> +7 (495) 123-45-67</span>
            <span><i class="fas fa-shop me-1"></i> ул. 9 Января, 195, Воронеж</span>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg border-bottom">
    <div class="container">
        <a class="navbar-brand me-3" href="{{ route('home') }}">БРИКС</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <a class="btn btn-white text-secondary rounded-2 border border-2 border-gray fw-bold px-3 text-nowrap"
                href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu"
                style="height:44px;margin-top:3px;padding-top:8px;">
                <i class="fa-solid fa-bars me-2"></i>Каталог
            </a>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-end gap-3">
                    <div class="position-relative d-flex align-items-center">
                        <input type="text"
                            class="search-input big-search rounded-2 border border-2 border-gray fw-bolder"
                            placeholder="Поиск..." />
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <div class="icon-item text-center">
                        <a href="#" class="d-block me-0 text-secondary text-decoration-none">
                            <i class="fas fa-bookmark fs-6"></i>
                            <div class="icon-label mt-0 text-light-emphasis fw-semibold">Избранное</div>
                        </a>

                    </div>
                    <div class="icon-item text-center border-white">
                        <a href="#" class="d-block me-0 text-secondary text-decoration-none">
                            <i class="fas fa-chart-simple fs-6"></i>
                            <div class="icon-label mt-0 text-light-emphasis fw-semibold">Сравнение</div>
                        </a>

                    </div>
                    <div class="icon-item text-center border-white">
                        <a href="#" class="d-block me-0 text-secondary text-decoration-none">
                            <i class="fas fa-shopping-cart fs-6"></i>
                            <div class="icon-label mt-0 text-light-emphasis fw-semibold">Корзина</div>
                        </a>

                    </div>
                </div>
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
