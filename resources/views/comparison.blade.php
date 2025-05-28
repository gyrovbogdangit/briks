@extends('layouts.master')

@section('css')
    @vite('resources/css/pages/comparison.css')
@endsection

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
    {{--
    @include('products.components.recently-watched')
    @include('components.frequent-questions')
    @include('components.cities')
    --}}
@endsection

@section('js')
    @vite('resources/js/pages/comparison.js')
@endsection
