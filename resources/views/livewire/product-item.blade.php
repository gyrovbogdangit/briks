<div class="product-card">
    <a
        href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
        <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
            alt="{{ $product->name }}" />
    </a>

    <div class="card-body">
        <h5 class="card-title text-primary"><a class="text-decoration-none"
                href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">{{ $product->name }}</a>
        </h5>

        @php
            $hasPiece = isset($product->price_per_piece);
            $hasPieceDiscount = isset($product->discount_price_per_piece);
            $hasSqm = isset($product->price_sqm);
            $hasSqmDiscount = isset($product->discount_price_sqm);
        @endphp
        @if ($hasPiece || $hasSqm)
            @if ($hasPiece)
                <div class="price-wrapper">
                    @if ($hasPieceDiscount)
                        <span class="old-price">{{ number_format($product->price_per_piece, 0, ',', ' ') }} ₽/шт</span>
                        <span class="new-price">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}
                            ₽/шт</span>
                    @else
                        <span class="new-price">{{ number_format($product->price_per_piece, 0, ',', ' ') }} ₽/шт</span>
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
                        <span class="new-price">{{ number_format($product->price_sqm, 0, ',', ' ') }} ₽/м²</span>
                    @endif
                </div>
            @endif
        @else
            <div class="price-wrapper">
                <span class="new-price">По запросу</span>
            </div>
        @endif

        {{-- Значки статуса и скидки --}}
        @if ($product->is_new || (isset($product->price) && isset($product->discount_price)))
            <div class="product-labels">
                @if ($product->is_new)
                    <div class="badge badge-warning">Новинка</div>
                @endif
                @if (isset($product->price) && isset($product->discount_price))
                    <div class="badge badge-danger">-{{ $product->discountPercentage() }}%</div>
                @endif
            </div>
        @endif

        <div class="action-icons">
            {{-- В корзине / Добавить в корзину / Запросить стоимость --}}
            @isset($product->price)
                @if ($quantity)
                    <a href="{{ route('cart') }}">
                        <i class="fas fa-cart-plus icon active" title="В корзине"></i>
                    </a>
                @else
                    <i class="fas fa-cart-plus icon" title="В корзину" wire:click="addToCart"></i>
                @endif
            @else
                <i class="fas fa-cart-plus icon" title="Запросить стоимость" data-fancybox
                    data-src="#order{{ $product->id }}"></i>
            @endisset

            {{-- Сравнение --}}
            @if ($inComparison)
                <i class="fas fa-chart-simple icon active" title="Убрать из сравнения"
                    wire:click="deleteFromComparison"></i>
            @else
                <i class="fas fa-chart-simple icon" title="Добавить в сравнение" wire:click="addToComparison"></i>
            @endif

            {{-- Избранное --}}
            @if ($inFavorites)
                <i class="fas fa-heart icon favorite active" title="Убрать из избранного"
                    wire:click="deleteFromFavorites"></i>
            @else
                <i class="fas fa-heart icon favorite" title="Добавить в избранное" wire:click="addToFavorites"></i>
            @endif
        </div>
    </div>

    {{--  @include('products.components.modal-request-price') --}}
</div>
