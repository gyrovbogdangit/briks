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
                    'name' => $productType->name,
                    'url' => route('product-types.show', ['productType' => $productType]),
                ],
            ],
        ])
        <div class="row mb-4">
            <div class="col-12" itemscope itemtype="https://schema.org/Product">
                <h1 class="fw-bold mb-2" itemprop="name">{{ $productType->name }}</h1>
                @if ($productType->description)
                    <div class="text-muted mb-3" itemprop="description">{!! $productType->description !!}</div>
                @endif
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 category-cards-grid">
            @foreach ($categories as $category)
                <div class="col" itemscope itemtype="https://schema.org/Product">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden d-flex flex-column">
                        <div class="bg-light border-bottom border-light-subtle">
                            <a class="d-flex align-items-center justify-content-center p-3"
                                href="{{ route('categories.show', ['productType' => $productType, 'category' => $category]) }}"
                                style="min-height: 112px;">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="img-fluid rounded-2" style="max-height: 140px; min-height: 140px; object-fit: contain;"
                                        itemprop="image">
                                @else
                                <span class="catalog-card-media-placeholder" aria-hidden="true" style="max-height: 140px; min-height: 140px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;">
                                    <i class="fa-solid fa-images"></i></span>
                                @endif
                            </a>
                        </div>
                        <div class="card-body p-3 d-flex flex-column flex-grow-1">
                            <h2 class="h6 fw-bold mb-2">
                                <a class="text-decoration-none text-dark" itemprop="url"
                                    href="{{ route('categories.show', ['productType' => $productType, 'category' => $category]) }}">
                                    <span itemprop="name">{{ $category->name }}</span>
                                </a>
                            </h2>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                @if ($category->subcategories->count())
                                    @foreach ($category->subcategories as $subcategory)
                                        <a href="{{ route('products.index', ['productType' => $productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                            class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2 small">
                                            {{ $subcategory->name }}
                                            <span class="text-muted">({{ $subcategory->products_count }})</span>
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ route('categories.show', ['productType' => $productType, 'category' => $category]) }}"
                                        class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2 small">
                                        Перейти в каталог
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (isset($productType->short_text) && isset($productType->long_text))
        <section class="py-5 bg-white">
            @include('components.description', [
                'shortDescription' => $productType->short_text,
                'longDescription' => $productType->long_text,
            ])
        </section>
    @endif

    <section class="py-5 bg-light">
        @include('components.latest-reviews')
    </section>

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
