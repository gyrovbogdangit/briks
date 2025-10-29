@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        @include('components.breadcrumbs', [
            'breadcrumbs' => [
                [
                    'name' => 'Главная',
                    'url' => route('home'),
                ],
                [
                    'name' => 'Каталог',
                    'url' => route('catalog'),
                ],
                [
                    'name' => $type->name,
                    'url' => route('product-types.show', ['productType' => $type]),
                ],
                [
                    'name' => $category->name,
                    'url' => route('categories.show', [
                        'productType' => $type,
                        'category' => $category,
                    ]),
                ],
                [
                    'name' => $subcategory->name,
                    'url' => route('products.index', [
                        'productType' => $type,
                        'category' => $category,
                        'subcategory' => $subcategory,
                    ]),
                ],
            ],
        ])
    </div>

    <div class="container">
        <h1 class="mb-3">{{ $subcategory->name }} <span class="text-muted fs-2">({{ $products->total() }})</span>
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
                @include('products.components.index.quick-filters')
                @include('products.components.index.sort-list-wrap')

                <button class="btn btn-primary d-block d-md-none w-100" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#filtersOffcanvas">
                    <i class="fas fa-filter me-2"></i>Фильтры
                </button>

                @include('products.components.index.active-filters')
            </div>

            @include('products.components.index.products')
        </div>
    </div>


    @if (isset($type->short_text) && isset($type->long_text))
        <section class="py-5 bg-white">
            @include('components.description', [
                'shortDescription' => $type->short_text,
                'longDescription' => $type->long_text,
            ])
        </section>
    @endif

    <section class="py-5 bg-light">
        @include('products.components.recently-watched')
    </section>

    <section class="py-5 bg-white">
        @include('components.popular-products')
    </section>

    <section class="py-5 bg-light">
        @include('components.new-products')
    </section>
@endsection
