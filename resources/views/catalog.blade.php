@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <nav class="breadcrumbs" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Главная</a></li>
                <li class="breadcrumb-item"><a href="#">Каталог</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Облицовочные материалы
                </li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <h1 class="page-title text-primary">Облицовочные материалы</h1>
    </div>

    <div class="container d-flex">
        <div class="filters-sidebar col-md-3" style="height: 100%">
            <div>
                <h2 class="fs-4 mb-3">Фильтры</h2>
                <div class="categories">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="category-link" data-bs-toggle="collapse" href="#bricksSubcategories" role="button"
                                aria-expanded="true" aria-controls="bricksSubcategories">
                                Кирпичи
                            </a>
                            <ul class="collapse list-group ms-3 show" id="bricksSubcategories">
                                <li class="list-group-item">
                                    Облицовочные кирпичи <span class="muted-text">(15)</span>
                                </li>
                                <li class="list-group-item">
                                    Керамические кирпичи <span class="muted-text">(10)</span>
                                </li>
                                <li class="list-group-item">
                                    Силикатные кирпичи <span class="muted-text">(8)</span>
                                </li>
                            </ul>
                        </li>

                        <li class="list-group-item">
                            <a class="category-link" data-bs-toggle="collapse" href="#tilesSubcategories" role="button"
                                aria-expanded="true" aria-controls="tilesSubcategories">
                                Черепица
                            </a>
                            <ul class="collapse list-group ms-3 show" id="tilesSubcategories">
                                <li class="list-group-item">
                                    Керамическая черепица <span class="muted-text">(5)</span>
                                </li>
                                <li class="list-group-item">
                                    Металлическая черепица <span class="muted-text">(7)</span>
                                </li>
                                <li class="list-group-item">
                                    Композитная черепица <span class="muted-text">(6)</span>
                                </li>
                            </ul>
                        </li>

                        <li class="list-group-item">
                            <a class="category-link" data-bs-toggle="collapse" href="#metalProfilesSubcategories"
                                role="button" aria-expanded="true" aria-controls="metalProfilesSubcategories">
                                Металлопрофиль
                            </a>
                            <ul class="collapse list-group ms-3 show" id="metalProfilesSubcategories">
                                <li class="list-group-item">
                                    Профнастил <span class="muted-text">(12)</span>
                                </li>
                                <li class="list-group-item">
                                    Металлические панели <span class="muted-text">(9)</span>
                                </li>
                                <li class="list-group-item">
                                    Сэндвич-панели <span class="muted-text">(14)</span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <hr />

                <div class="categories">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="category-link" data-bs-toggle="collapse" href="#brandsSubcategories" role="button"
                                aria-expanded="true" aria-controls="brandsSubcategories">
                                Бренд
                            </a>
                            <ul class="collapse list-group ms-3 show" id="brandsSubcategories">
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />
                                    Faber Jar <span class="muted-text">(10)</span>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />Тандем
                                    <span class="muted-text">(5)</span>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />Baksteen
                                    <span class="muted-text">(8)</span>
                                </li>
                            </ul>
                        </li>
                        <hr />
                        <li class="list-group-item">
                            <a class="category-link" data-bs-toggle="collapse" href="#countriesSubcategories" role="button"
                                aria-expanded="true" aria-controls="countriesSubcategories">
                                Страна производитель
                            </a>
                            <ul class="collapse list-group ms-3 show" id="countriesSubcategories">
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />Россия<span
                                        class="muted-text">(21)</span>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />Китай
                                    <span class="muted-text">(15)</span>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="filter-checkbox me-1" />Германия
                                    <span class="muted-text">(12)</span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <button class="btn btn-primary btn-show mt-3 w-100">Применить фильтры</button>
            </div>
        </div>

        <div class="col-md-9">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap p-3 rounded-3 shadow-sm bg-body">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="sort-label">Показывать:</span>
                        <a href="#" class="filter-link text-primary">20</a>
                        <a href="#" class="filter-link text-primary">40</a>
                        <a href="#" class="filter-link text-primary">60</a>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="sort-label">Сортировка:</span>
                        <a href="#" class="filter-link text-primary">По популярности</a>
                        <a href="#" class="filter-link text-primary">Сначала дешевые</a>
                        <a href="#" class="filter-link text-primary">Сначала дорогие</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="products-grid">
                    @foreach (range(1, 8) as $i)
                        <div class="product-card">
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
                <div class="container mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Предыдущая</a>
                            </li>
                            <li class="page-item"><a class="page-link text-primary" href="#">1</a></li>
                            <li class="page-item"><a class="page-link text-primary" href="#">2</a></li>
                            <li class="page-item"><a class="page-link text-primary" href="#">3</a></li>
                            <li class="page-item"><a class="page-link text-primary" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link text-primary" href="#">Следующая</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
