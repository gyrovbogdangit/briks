@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                <div class="mb-4">
                    <h1 class="display-5 fw-bold text-primary mb-3">Сравнение товаров</h1>
                </div>
                <livewire:comparison-component />
            </div>
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

@section('js')
    @vite('resources/js/pages/comparison.js')
@endsection
