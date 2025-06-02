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

    <div class="modal fade" id="requestCartModal" tabindex="-1" aria-labelledby="requestCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestCartModalLabel">Заявка на оформление заказа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <livewire:modal-request-cart />
            </div>
        </div>
    </div>

    {{--
    @include('products.components.recently-watched')
    @include('components.frequent-questions')
    @include('components.cities')
    --}}
@endsection
