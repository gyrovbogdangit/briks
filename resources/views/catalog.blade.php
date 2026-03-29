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
            ],
        ])
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold mb-2" itemprop="name">Каталог</h1>
                <div class="text-muted mb-3">Выберите интересующий вас раздел</div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 category-cards-grid" itemscope
            itemtype="https://schema.org/CollectionPage">
            @foreach ($types as $type)
                <div class="col" itemscope itemtype="https://schema.org/Product">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden d-flex flex-column">
                        <div class="bg-light border-bottom border-light-subtle">
                            <a class="d-flex align-items-center justify-content-center p-3"
                                href="{{ route('product-types.show', ['productType' => $type]) }}"
                                style="min-height: 112px;">
                                @if ($type->image)
                                    <img src="{{ asset('storage/' . $type->image) }}" alt="Фото {{ $type->name }}"
                                        class="img-fluid rounded-2" style="max-height: 140px; object-fit: contain;"
                                        itemprop="image">
                                @else
                                    <span class="catalog-card-media-placeholder" aria-hidden="true" style="max-height: 140px; min-height: 140px; object-fit: contain;"><i
                                            class="fa-solid fa-images"></i></span>
                                @endif
                            </a>
                        </div>
                        <div class="card-body p-3 d-flex flex-column flex-grow-1">
                            <h2 class="h6 fw-bold mb-2">
                                <a class="text-decoration-none text-dark" itemprop="url"
                                    href="{{ route('product-types.show', ['productType' => $type]) }}">
                                    <span itemprop="name">{{ $type->name }}</span>
                                </a>
                            </h2>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                @if ($type->categories->count())
                                    @foreach ($type->categories as $category)
                                        <a href="{{ route('categories.show', ['productType' => $type, 'category' => $category]) }}"
                                            class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2 small">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                @else
                                    <a href="{{ route('product-types.show', ['productType' => $type]) }}"
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

    <section class="py-5 bg-white">
        @include('products.components.recently-watched')
    </section>

    <section class="py-5 bg-light">
        @include('components.popular-products')
    </section>

    <section class="py-5 bg-white">
        @include('components.new-products')
    </section>
@endsection
