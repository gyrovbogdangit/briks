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
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-2">Каталог</h1>
                <div class="text-muted mb-3">Выберите интересующий вас раздел</div>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($types as $type)
                <div class="col-12 col-md-10 col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="row g-0 align-items-center">
                            @isset($type->image)
                                <div class="col-12 col-md-4 text-center bg-white py-3 px-2">
                                    <a href="{{ route('product-types.show', ['productType' => $type]) }}">
                                        <img src="{{ asset('storage/' . $type->image) }}" alt="Фото {{ $type->name }}"
                                            class="img-fluid rounded-3" style="max-height:120px;object-fit:contain;">
                                    </a>
                                </div>
                            @endisset
                            <div class="col-12 col-md-8 p-3 @if (!isset($type->image)) ms-5 @endif">
                                <h2 class="h5 fw-bold mb-2"><a class="text-decoration-none text-dark"
                                        href="{{ route('product-types.show', ['productType' => $type]) }}">{{ $type->name }}</a>
                                </h2>
                                @if ($type->categories->count())
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @foreach ($type->categories as $category)
                                            <a class="text-decoration-none"
                                                href="{{ route('categories.show', ['productType' => $type, 'category' => $category]) }}">
                                                <div
                                                    class="bg-primary-subtle text-primary text-decoration-none fw-normal px-2 py-1 rounded-2">
                                                    {{ $category->name }}</div>
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
