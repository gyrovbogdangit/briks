<div class="bg-white rounded-3 shadow-sm p-4 border-0 h-100">
    <div class="container">
        <div class="d-flex align-items-center gap-3 mb-3">
            <h1 class="mb-0 fs-2">{{ $product->name }}</h1>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-row-reverse gap-2">
        @if ($product->is_new)
            <span class="text-bg-secondary py-1 px-2 rounded-3 fw-semibold">Новинка</span>
        @endif
        @if ($product->is_hit_of_sales)
            <span class="text-bg-danger py-1 px-2 rounded-3 fw-semibold">Хит продаж</span>
        @endif
    </div>

    @php
        $hasPiece = isset($product->price_per_piece);
        $hasPieceDiscount = isset($product->discount_price_per_piece);
        $hasSqm = isset($product->price_sqm);
        $hasSqmDiscount = isset($product->discount_price_sqm);
    @endphp

    <div class="mb-4 d-flex justify-content-end">
        @if ($hasPiece || $hasSqm)
            <div>
                @if ($hasPiece)
                    <div class="d-flex align-items-end justify-content-end gap-2 flex-wrap mb-1">
                        @if ($hasPieceDiscount)
                            <span
                                class="fs-3 fw-bold text-danger">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                            <span
                                class="text-muted text-decoration-line-through">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                            <span
                                class="badge bg-danger align-middle ms-2">-{{ floor(100 - ($product->discount_price_per_piece / $product->price_per_piece) * 100) }}%</span>
                        @else
                            <span class="fs-3 fw-bold">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                        @endif
                    </div>
                @endif
                @if ($hasSqm)
                    <div class="d-flex align-items-end justify-content-end gap-2 flex-wrap">
                        @if ($hasSqmDiscount)
                            <span
                                class="fs-5 fw-bold text-danger">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                            <span
                                class="text-muted text-decoration-line-through">{{ number_format($product->price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                            <span
                                class="badge bg-danger align-middle ms-2">-{{ floor(100 - ($product->discount_price_sqm / $product->price_sqm) * 100) }}%</span>
                        @else
                            <span class="fs-5 fw-bold">{{ number_format($product->price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div class="fs-5 fw-semibold text-secondary">По запросу</div>
        @endif
    </div>

    <livewire:product-actions :product="$product" />

    <div class="table-responsive mb-3 rounded-3 p-2 bg-light-subtle">
        <table class="table table-sm align-middle mb-0">
            <tbody>
                @foreach ($product->attributeValues->take(5) as $attributeValue)
                    <tr>
                        <th class="bg-light text-secondary fw-semibold border-0" style="width: 40%">
                            {{ $attributeValue->attribute->name }}</th>
                        <td class="border-0">{{ $attributeValue->value->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
        <a class="btn btn-outline-primary rounded-3 px-4 py-2 shadow-sm w-100" href="#chars" data-bs-toggle="tab" data-bs-target="#chars" role="tab" aria-controls="chars">
            <i class="fa-solid fa-down-long"></i> Все характеристики
        </a>
        @isset($product->article)
            <div class="text-muted small">Артикул: <span class="fw-semibold">{{ $product->article }}</span></div>
        @endisset
    </div>
</div>
