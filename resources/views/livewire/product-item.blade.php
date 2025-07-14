<div class="product-card rounded-3 bg-white shadow-sm h-100 d-flex flex-column w-100"
    style="width:220px;min-height:330px">
    <a
        href="{{ route('products.show', ['productType' => $product->subcategory->productType, 'category' => $product->subcategory->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
        <img src="
            @if (isset($product->thumbs[0])) {{ Storage::url($product->thumbs[0]) }}
            @elseif (isset($product->images[0])) {{ Storage::url($product->images[0]) }}
            @else {{ asset('img/content/product-1.jpg') }} @endif"
            alt="{{ $product->name }}" class="rounded-top-2 w-100" style="height:160px; object-fit:cover;" />
    </a>

    <div class="card-body p-3 d-flex flex-column h-100">
        <h5 class="card-title text-primary fs-6 fw-bold" style="max-height: 60px;"><a class="text-decoration-none"
                href="{{ route('products.show', ['productType' => $product->subcategory->productType, 'category' => $product->subcategory->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
                {{ Illuminate\Support\Str::limit($product->name, 60) }}
            </a>
        </h5>

        @php
            $hasPiece = isset($product->price_per_piece);
            $hasPieceDiscount = isset($product->discount_price_per_piece);
            $hasSqm = isset($product->price_sqm);
            $hasSqmDiscount = isset($product->discount_price_sqm);
        @endphp

        <div class="mt-auto">
            @if ($hasPiece || $hasSqm)
                @if ($hasPiece)
                    <div class="price-wrapper">
                        @if ($hasPieceDiscount)
                            <span class="old-price">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                            <span class="new-price">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                        @else
                            <span class="new-price ms-auto">{{ number_format($product->price_per_piece, 0, ',', ' ') }}
                                ₽/шт</span>
                        @endif
                    </div>
                @endif
                @if ($hasSqm)
                    <div class="price-wrapper">
                        @if ($hasSqmDiscount)
                            <span class="old-price">{{ number_format($product->price_sqm, 0, ',', ' ') }} ₽/м²</span>
                            <span class="new-price">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                        @else
                            <span class="new-price ms-auto">{{ number_format($product->price_sqm, 0, ',', ' ') }}
                                ₽/м²</span>
                        @endif
                    </div>
                @endif
            @else
                <div class="price-wrapper">
                    <span class="new-price">По запросу</span>
                </div>
            @endif
        </div>

        <div class="action-icons bg-light rounded-2 p-2 border mt-2">
            @if ($quantity)
                <a class="fas fa-cart-plus icon active text-decoration-none" href="{{ route('cart') }}"
                    title="В корзине"></a>
            @else
                <i class="fas fa-cart-plus icon" title="В корзину" wire:click="addToCart"></i>
            @endif

            @if ($inComparison)
                <a class="fas fa-chart-simple icon active text-decoration-none text-warning" title="Убрать из сравнения"
                    wire:click="deleteFromComparison"></a>
            @else
                <i class="fas fa-chart-simple icon" title="Добавить в сравнение" wire:click="addToComparison"></i>
            @endif

            @if ($inFavorites)
                <a class="fas fa-heart icon favorite active text-decoration-none text-danger"
                    title="Убрать из избранного" wire:click="deleteFromFavorites"></a>
            @else
                <i class="fas fa-heart icon favorite" title="Добавить в избранное" wire:click="addToFavorites"></i>
            @endif
        </div>

        @if ($product->is_new || (isset($product->price_per_piece) && isset($product->discount_price_per_piece)))
            <div class="product-labels">
                @if ($product->is_new)
                    <div class="badge text-bg-secondary"><i class="fa-solid fa-plus"></i> Новинка</div>
                @endif
                @if ($product->is_hit_of_sales)
                    <div class="badge text-bg-danger">Хит продаж</div>
                @endif
                @if (isset($product->price_per_piece) && isset($product->discount_price_per_piece))
                    <div class="badge text-bg-danger">-{{ $product->discountPercentage() }}%</div>
                @endif
            </div>
        @endif

    </div>
</div>
