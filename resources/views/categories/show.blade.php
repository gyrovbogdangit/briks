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
            <div class="col-12 text-center" itemscope itemtype="https://schema.org/Product">
                <h1 class="fw-bold mb-2" itemprop="name">{{ $category->name }}</h1>
                @if ($category->description)
                    <div class="text-muted mb-3" itemprop="description">{!! $category->description !!}</div>
                @endif
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($subcategories as $subcategory)
                <div class="col-12 col-md-10 col-lg-8 mb-4" itemscope itemtype="https://schema.org/Product">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="row g-0 align-items-center">
                            @isset($subcategory->products[0]->images[0])
                                <div class="col-12 col-md-4 text-center bg-white py-3 px-2">
                                    <a
                                        href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}">
                                        <img src="{{ asset('storage/' . $subcategory->products[0]->images[0]) }}"
                                            alt="{{ $subcategory->name }}" class="img-fluid rounded-3"
                                            style="max-height:100px;object-fit:contain;" itemprop="image">
                                    </a>
                                </div>
                            @endisset
                            <div class="col-12 col-md-8 p-3 @if (!isset($subcategory->products[0]->images[0])) ms-5 @endif">
                                <h2 class="h5 fw-bold mb-2"><a
                                        href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                        class="text-decoration-none text-dark" itemprop="url"><span itemprop="name">{{ $subcategory->name }}</span></a>
                                </h2>
                                <a href="{{ route('products.index', ['productType' => $category->productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                    class="rounded-2 bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1">
                                    Смотреть товары <span
                                        class="text-muted small">({{ $subcategory->products_count }})</span>
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
