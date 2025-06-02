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
                [
                    'name' => $product->name,
                    'url' => route('products.show', [
                        'productType' => $type,
                        'category' => $category,
                        'subcategory' => $subcategory,
                        'product' => $product,
                    ]),
                ],
            ],
        ])
    </div>

    <div class="container mb-4">
        <div class="row g-4">
            <div class="col-md-6">
                @include('products.components.show.slider')
            </div>
            <div class="col-md-6">
                @include('products.components.show.short-info')
            </div>
        </div>

        @if ($product->is_active)
            <div class="row mt-4">
                <div class="col-12">
                    @include('products.components.show.product-info')
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-4">
                К сожалению сейчас этот товар не доступен. С его аналогами можете ознакомиться в
                <a href="{{ route('products.index', ['productType' => $type, 'category' => $type->categories[0], 'subcategory' => $type->categories[0]->subcategories[0]]) }}"
                    class="text-primary">нашем каталоге</a>!
            </div>
        @endif
    </div>

    @include('products.components.show.modal-one-click-order')
    {{--  @include('products.components.modal-request-price')

    <div class="container mt-5">
        @include('products.components.why-choose-us')
        @include('products.components.show.related-products')
        @include('products.components.recently-watched')
        @include('components.frequent-questions')
    </div> --}}
@endsection
