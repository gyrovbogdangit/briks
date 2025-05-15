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
        @include('products.components.index.filters')

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
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <livewire:product-item :product="$product" />
                        @endforeach
                    @else
                        <p>Нечего не найдено. Возможно вы выбрали слишком много фильтров.
                            <a
                                href="{{ route('products.index', ['productType' => $type, 'category' => $filter->category, 'subcategory' => $filter->subcategory]) }}">Очистить
                                фильтры.</a>
                        </p>
                    @endif
                </div>
                <div class="container mt-4">
                    @include('products.components.index.pagination')
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="wrap wrap--light-gray">
        <div class="content">

            <div class="bread">
                <a href="{{ route('home') }}" class="bread__link">Главная</a>
                <span class="bread__sep"><i class="icon-arrow1"></i></span>
                <a href="{{ route('catalog') }}" class="bread__link">Каталог</a>
                <span class="bread__sep"><i class="icon-arrow1"></i></span>
                <a class="bread__link">{{ $type->name }}</a>
                <span class="bread__sep"><i class="icon-arrow1"></i></span>
                <a class="bread__link">{{ $category->name }}</a>
                <span class="bread__sep"><i class="icon-arrow1"></i></span>
                <a class="bread__link">{{ $subcategory->name }}</a>
            </div>

            <div class="title title--inline">
                <h1>{{ $subcategory->name }}</h1>
                <span class="title__sum">{{ $products->total() }} товаров</span>
            </div>

        </div>
    </div>

    <div class="wrap">
        <div class="page content">
            <div class="wrap-products">
                @include('products.components.index.filters')
                @include('products.components.index.products')
            </div>
        </div>
    </div>

    @include('products.components.why-choose-us')
    @include('products.components.recently-watched')
    @include('products.components.index.description')
    @include('components.frequent-questions') --}}
@endsection
