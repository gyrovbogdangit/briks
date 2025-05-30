@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <nav class="breadcrumbs" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Главная</a></li>
                <li class="breadcrumb-item"><a href="#">Каталог</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $type->name }}
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $category->name }}
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $subcategory->name }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <h1 class="text-primary mb-3">{{ $subcategory->name }} <span
                class="text-muted fs-2">({{ $products->total() }})</span>
        </h1>
    </div>

    <div class="container d-flex mb-5">
        <div class="d-none d-md-block col-md-3">
            @include('products.components.index.filters')
        </div>

        <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="filtersOffcanvas"
            aria-labelledby="filtersOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="filtersOffcanvasLabel">Фильтры</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="">
                    @include('products.components.index.filters')
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="container d-flex flex-column gap-3">
                @include('products.components.index.search-links')
                @include('products.components.index.active-filters')

                @include('products.components.index.sort-list-wrap')

                <button class="btn btn-primary d-block d-md-none w-100" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#filtersOffcanvas">
                    <i class="fas fa-filter me-2"></i>Фильтры
                </button>
            </div>

            @include('products.components.index.products')
        </div>
    </div>

    {{--
    @include('products.components.why-choose-us')
    @include('products.components.recently-watched')
    @include('products.components.index.description')
    @include('components.frequent-questions')
    --}}
@endsection
