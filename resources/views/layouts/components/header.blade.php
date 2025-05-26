<div class="top-nav py-2">
    <div class="container d-flex justify-content-between align-items-center fw-bolder">
        <div class="d-flex">
            <div class="" style="width: 200px"><i class="fas fa-map-marker-alt"></i> Ваш город: Москва</div>
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

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand me-0" style="width: 200px" href="{{ route('home') }}">БРИКС</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn-light text-primary rounded-2 border border-2 border-white fw-bold px-3"
                        href="#" data-bs-toggle="offcanvas" data-bs-target="#catalog-menu"
                        style="font-size: 1.1rem;height:44px"><i <i class="fa-solid fa-bars me-2"></i></i>Каталог</a>
                </li>
            </ul>
            <div class="position-relative d-flex align-items-center">
                <input type="text" class="search-input big-search rounded-2 border border-2 border-white fw-bolder"
                    placeholder="Поиск..." />
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="d-flex align-items-center">
                <div class="icon-group d-flex align-items-end gap-3">
                    <div class="icon-item text-center border-white border border-2 rounded-2 px-2 py-2">
                        <a href="#" class="d-block me-0 reset-link text-light"><i
                                class="fa-solid fa-bookmark fs-5" style="width: 25px"></i></a>
                        {{--  <div class="icon-label">Избранное</div> --}}
                    </div>
                    <div class="icon-item text-center border-white border border-2 rounded-2 px-2 py-2">
                        <a href="#" class="d-block me-0 reset-link text-light"><i class="fas fa-chart-simple fs-5"
                                style="width: 25px"></i></a>
                        {{--  <div class="icon-label">Сравнение</div> --}}
                    </div>
                    <div class="icon-item text-center border-white border border-2 rounded-2 px-2 py-2">
                        <a href="#" class="d-block me-0 reset-link text-light"><i
                                class="fas fa-shopping-cart fs-5" style="width: 25px"></i></a>
                        {{--  <div class="icon-label">Корзина</div> --}}
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
