    <div class="bg-white rounded-3 shadow-sm p-4 border-0 h-100">
        <div class="container">
            <div class="d-flex align-items-center gap-3 mb-3">
                <h1 class="mb-0 fs-2" itemprop="name">{{ $product->name }}</h1>
            </div>
        </div>    <div class="d-flex justify-content-between flex-row-reverse gap-2">
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
        $hasM3 = isset($product->price_m3);
        $hasM3Discount = isset($product->discount_price_m3);
    @endphp

    <div class="mb-4 d-flex justify-content-end" itemscope itemtype="https://schema.org/PriceSpecification">
        @if ($hasPiece || $hasSqm || $hasM3)
            <div>
                @if ($hasPiece)
                    <div class="d-flex align-items-end justify-content-end gap-2 flex-wrap mb-1">
                        @if ($hasPieceDiscount)
                            <span
                                class="fs-3 fw-bold text-danger" itemprop="price" content="{{ $product->discount_price_per_piece }}">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                            <span
                                class="text-muted text-decoration-line-through">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                            <span
                                class="badge bg-danger align-middle ms-2">-{{ floor(100 - ($product->discount_price_per_piece / $product->price_per_piece) * 100) }}%</span>
                        @else
                            <span class="fs-3 fw-bold" itemprop="price" content="{{ $product->price_per_piece }}">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                        @endif
                    </div>
                @endif
                @if ($hasSqm)
                    <div class="d-flex align-items-end justify-content-end gap-2 flex-wrap mb-1">
                        @if ($hasSqmDiscount)
                            <span
                                class="fs-5 fw-bold text-danger" itemprop="price" content="{{ $product->discount_price_sqm }}">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                            <span
                                class="text-muted text-decoration-line-through">{{ number_format($product->price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                            <span
                                class="badge bg-danger align-middle ms-2">-{{ floor(100 - ($product->discount_price_sqm / $product->price_sqm) * 100) }}%</span>
                        @else
                            <span class="fs-5 fw-bold" itemprop="price" content="{{ $product->price_sqm }}">{{ number_format($product->price_sqm, 0, ',', ' ') }} ₽/м²</span>
                        @endif
                    </div>
                @endif
                @if ($hasM3)
                    <div class="d-flex align-items-end justify-content-end gap-2 flex-wrap mb-1">
                        @if ($hasM3Discount)
                            <span
                                class="fs-5 fw-bold text-danger" itemprop="price" content="{{ $product->discount_price_m3 }}">{{ number_format($product->discount_price_m3, 0, ',', ' ') }}
                                ₽/м³</span>
                            <span
                                class="text-muted text-decoration-line-through">{{ number_format($product->price_m3, 0, ',', ' ') }}
                                ₽/м³</span>
                            <span
                                class="badge bg-danger align-middle ms-2">-{{ floor(100 - ($product->discount_price_m3 / $product->price_m3) * 100) }}%</span>
                        @else
                            <span class="fs-5 fw-bold" itemprop="price" content="{{ $product->price_m3 }}">{{ number_format($product->price_m3, 0, ',', ' ') }} ₽/м³</span>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div class="fs-5 fw-semibold text-secondary">По запросу</div>
        @endif
    </div>
    <meta itemprop="priceCurrency" content="RUB" />

    <livewire:product-actions :product="$product" />

    <div class="table-responsive mb-3 rounded-3 p-2 bg-light-subtle" itemscope itemtype="https://schema.org/PropertyValue">
        <table class="table table-sm align-middle mb-0">
            <tbody>
                @foreach ($product->attributeValues->take(5) as $attributeValue)
                    <tr>
                        <th class="bg-light text-secondary fw-semibold border-0" style="width: 40%" itemprop="name">
                            {{ $attributeValue->attribute->name }}</th>
                        <td class="border-0" itemprop="value">{{ $attributeValue->value->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
        <a class="btn btn-outline-primary rounded-3 px-4 py-2 shadow-sm w-100" href="#chars" data-bs-toggle="tab"
            data-bs-target="#chars" role="tab" aria-controls="chars">
            <i class="fa-solid fa-down-long"></i> Все характеристики
        </a>
        @isset($product->article)
            <div class="text-muted small">Артикул: <span class="fw-semibold" itemprop="sku">{{ $product->article }}</span></div>
        @endisset
    </div>
</div>
