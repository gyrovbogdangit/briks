@extends('layouts.mail')

@section('content')
    <div>
        <h1>Отправлен запрос на стоимость</h1>

        <div class="email-content">
            @include('mail.components.client')
            @include('mail.components.comment')
            @include('mail.components.product-name')

            @isset($quantity)
                <section>
                    <p><b>В количестве:</b> {{ $quantity }} шт.</p>
                </section>
            @endisset

        </div>

        <div>
            <table style="width:100%;border-collapse:collapse;">
                <tr style="background:#f8f9fa;">
                    <th style="padding:8px;border:1px solid #dee2e6;">Характеристика</th>
                    <th style="padding:8px;border:1px solid #dee2e6;">Значение</th>
                </tr>
                <tr>
                    <td style="padding:8px;border:1px solid #dee2e6;">Товар</td>
                    <td style="padding:8px;border:1px solid #dee2e6;">@include('mail.components.product-name')</td>
                </tr>
                <tr>
                    <td style="padding:8px;border:1px solid #dee2e6;">Тип товара</td>
                    <td style="padding:8px;border:1px solid #dee2e6;">
                        {{ $product->subcategory->category->productType->name }}</td>
                </tr>
                <tr>
                    <td style="padding:8px;border:1px solid #dee2e6;">Категория</td>
                    <td style="padding:8px;border:1px solid #dee2e6;">{{ $product->category->name }}</td>
                </tr>
                @if (isset($product->price_sqm) || isset($product->discount_price_sqm))
                    <tr>
                        <td style="padding:8px;border:1px solid #dee2e6;">Цена за м²</td>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            @if (isset($product->discount_price_sqm))
                                <span
                                    style="color:#dc3545;font-weight:bold;">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}₽</span>
                                <span
                                    style="text-decoration:line-through;color:#6c757d;">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽</span>
                            @else
                                <span>{{ number_format($product->price_sqm, 0, ',', ' ') }}₽</span>
                            @endif
                        </td>
                    </tr>
                @endif
                @if (isset($product->price_per_piece) || isset($product->discount_price_per_piece))
                    <tr>
                        <td style="padding:8px;border:1px solid #dee2e6;">Цена за шт</td>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            @if (isset($product->discount_price_per_piece))
                                <span
                                    style="color:#dc3545;font-weight:bold;">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}₽</span>
                                <span
                                    style="text-decoration:line-through;color:#6c757d;">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽</span>
                            @else
                                <span>{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽</span>
                            @endif
                        </td>
                    </tr>
                @endif
                @isset($quantity)
                    <tr>
                        <td style="padding:8px;border:1px solid #dee2e6;">Количество</td>
                        <td style="padding:8px;border:1px solid #dee2e6;">{{ $quantity }} шт</td>
                    </tr>
                @endisset
            </table>
        </div>
    </div>
@endsection
