@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="mb-4">
                    <h1 class="display-5 fw-bold text-primary mb-3">Корзина</h1>
                </div>
                <livewire:cart.cart-component />
            </div>
        </div>
    </div>
    {{--
    <div style="display: none;" class="modal modal--bottom" id="request-cart">
        <livewire:modal-request-cart />
    </div>
    --}}
    {{--
    @include('products.components.recently-watched')
    @include('components.frequent-questions')
    @include('components.cities')
    --}}
@endsection
