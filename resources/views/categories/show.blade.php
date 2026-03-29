@extends('layouts.master')

@section('content')
    <div class="container py-4">
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
                    'name' => $category->productType->name,
                    'url' => route('product-types.show', ['productType' => $category->productType]),
                ],
                [
                    'name' => $category->name,
                    'url' => route('categories.show', [
                        'productType' => $category->productType,
                        'category' => $category,
                    ]),
                ],
            ],
        ])
        <div class="row mb-4">
            <div class="col-12" itemscope itemtype="https://schema.org/Product">
                <h1 class="fw-bold mb-2" itemprop="name">{{ $category->name }}</h1>
                @if ($category->description)
                    <div class="text-muted mb-3" itemprop="description">{!! $category->description !!}</div>
                @endif
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 category-cards-grid">
            @foreach ($subcategories as $subcategory)
                <div class="col" itemscope itemtype="https://schema.org/Product">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden d-flex flex-column">
                        <div class="bg-light border-bottom border-light-subtle">
                            <a class="d-flex align-items-center justify-content-center p-3"
                                href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                style="min-height: 112px;">
                                @isset($subcategory->products[0]->images[0])
                                    <img src="{{ asset('storage/' . $subcategory->products[0]->images[0]) }}"
                                        alt="{{ $subcategory->name }}" class="img-fluid rounded-2"
                                        style="max-height: 140px; object-fit: contain;"                                         itemprop="image">
                                @else
                                    <span class="catalog-card-media-placeholder" aria-hidden="true"><i
                                            class="fa-solid fa-images"></i></span>
                                @endisset
                            </a>
                        </div>
                        <div class="card-body p-3 d-flex flex-column flex-grow-1">
                            <h2 class="h6 fw-bold mb-2">
                                <a class="text-decoration-none text-dark" itemprop="url"
                                    href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}">
                                    <span itemprop="name">{{ $subcategory->name }}</span>
                                </a>
                            </h2>
                            <div class="mt-auto pt-2">
                                <a href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                    class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2 small d-inline-flex align-items-center gap-1">
                                    Смотреть товары
                                    <span class="text-muted">({{ $subcategory->products_count }})</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if ((isset($category->short_text) && isset($category->long_text)) || (isset($category->productType->short_text) && isset($category->productType->long_text)))
        <section class="py-5 bg-white">
            @include('components.description', [
                'shortDescription' => empty($category->short_text) ? $category->productType->short_text : $category->short_text,
                'longDescription' => empty($category->long_text) ? $category->productType->long_text : $category->long_text,
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
