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
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-2">{{ $productType->name }}</h1>
                @if ($productType->description)
                    <div class="text-muted mb-3">{!! $productType->description !!}</div>
                @endif
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($categories as $category)
                <div class="col-12 col-md-10 col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="row g-0 align-items-center">
                            @isset($category->image)
                                <div class="col-12 col-md-4 text-center bg-white py-3 px-2">
                                    <a
                                        href="{{ route('categories.show', ['productType' => $productType, 'category' => $category]) }}">
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            class="img-fluid rounded-3" style="max-height:100px;object-fit:contain;">
                                    </a>
                                </div>
                            @endisset
                            <div class="col-12 col-md-8 p-3 @if (!isset($category->image)) ms-5 @endif">
                                <h2 class="h5 fw-bold mb-2"><a class="text-decoration-none text-dark"
                                        href="{{ route('categories.show', ['productType' => $productType, 'category' => $category]) }}">{{ $category->name }}</a>
                                </h2>
                                @if ($category->subcategories->count())
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @foreach ($category->subcategories as $subcategory)
                                            <a href="{{ route('products.index', ['productType' => $productType, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                                class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2">
                                                {{ $subcategory->name }}
                                                <span class="text-muted small">({{ $subcategory->products_count }})</span>
                                            </a>
                                        @endforeach
                                    </div>
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
        @include('products.components.recently-watched')
    </section>

    <section class="py-5 bg-white">
        @include('components.popular-products')
    </section>

    <section class="py-5 bg-light">
        @include('components.new-products')
    </section>
@endsection
