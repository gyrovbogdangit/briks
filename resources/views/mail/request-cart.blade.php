@extends('layouts.mail')

@section('content')
    <div>
        <h1>Отправлена заявка на заказ</h1>

        <div class="email-content">
            @include('mail.components.client')
            @include('mail.components.comment')
        </div>

        <div>
            <table style="width:100%;border-collapse:collapse;">
                <tr style="background:#f8f9fa;">
                    <th style="padding:8px;border:1px solid #dee2e6;">Товар</th>
                    <th style="padding:8px;border:1px solid #dee2e6;">Кол-во</th>
                    <th style="padding:8px;border:1px solid #dee2e6;">Цена за ед.</th>
                    <th style="padding:8px;border:1px solid #dee2e6;">Общая цена</th>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            <a
                                href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            {{ $product->quantity }} {{ $product->unit === 'sqm' ? 'м²' : 'шт' }}
                        </td>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            @if (isset($product->discount_price_sqm) || isset($product->price_sqm))
                                <div>
                                    <span>м²: </span>
                                    @if (isset($product->discount_price_sqm))
                                        <span
                                            style="color:#dc3545;font-weight:bold;">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}₽</span>
                                        <span
                                            style="text-decoration:line-through;color:#6c757d;">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽</span>
                                    @else
                                        <span>{{ number_format($product->price_sqm, 0, ',', ' ') }}₽</span>
                                    @endif
                                </div>
                            @endif
                            @if (isset($product->discount_price_per_piece) || isset($product->price_per_piece))
                                <div>
                                    <span>шт: </span>
                                    @if (isset($product->discount_price_per_piece))
                                        <span
                                            style="color:#dc3545;font-weight:bold;">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}₽</span>
                                        <span
                                            style="text-decoration:line-through;color:#6c757d;">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽</span>
                                    @else
                                        <span>{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td style="padding:8px;border:1px solid #dee2e6;">
                            @if ($product->unit === 'sqm')
                                @php $price = $product->discount_price_sqm ?? $product->price_sqm; @endphp
                                {{ number_format($price * $product->quantity, 0, ',', ' ') }}₽ за {{ $product->quantity }}
                                м²
                            @else
                                @php $price = $product->discount_price_per_piece ?? $product->price_per_piece; @endphp
                                {{ number_format($price * $product->quantity, 0, ',', ' ') }}₽ за {{ $product->quantity }}
                                шт
                            @endif
                        </td>
                    </tr>
                @endforeach

                <tr style="background:#f8f9fa;">
                    <th style="padding:8px;border:1px solid #dee2e6;" colspan="3">Сумма:</th>
                    <th style="padding:8px;border:1px solid #dee2e6;">{{ number_format($totalSum, 0, ',', ' ') }}₽</th>
                </tr>
            </table>
        </div>
    </div>
@endsection
