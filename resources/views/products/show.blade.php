@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <nav class="breadcrumbs" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{-- {{ route('catalog') }} --}}">Каталог</a></li>
                <li class="breadcrumb-item"><a>{{ $type->name }}</a></li>
                <li class="breadcrumb-item"><a>{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('products.index', ['productType' => $type, 'category' => $category, 'subcategory' => $subcategory]) }}">{{ $subcategory->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container">
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

    {{--  @include('products.components.modal-request-price')
    @include('products.components.show.modal-one-click-order')

    <div class="container mt-5">
        @include('products.components.why-choose-us')
        @include('products.components.show.related-products')
        @include('products.components.recently-watched')
        @include('components.frequent-questions')
    </div> --}}
@endsection
