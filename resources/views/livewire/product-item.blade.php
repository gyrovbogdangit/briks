<div class="product-card p-2 bg-white shadow-sm h-100 d-flex flex-column w-100" style="width:220px;"
    vocab="https://schema.org/" typeof="Product" itemscope itemtype="https://schema.org/Product">

    <a href="{{ route('products.show', ['productType' => $product->subcategory->productType, 'category' => $product->subcategory->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}"
        itemprop="url">
        <img src="
            @if (isset($product->thumbs[0])) {{ Storage::url($product->thumbs[0]) }}
            @elseif (isset($product->images[0])) {{ Storage::url($product->images[0]) }}
            @else {{ asset('img/content/product-1.jpg') }} @endif"
            loading="lazy" alt="{{ $product->name }}" class="w-100 d-block" property="image" itemprop="image" />
    </a>

    <div class="card-body px-2 pt-2 d-flex flex-column h-100">
        <div class="card-title fs-6 fw-bold" style="max-height: 60px;line-height: 1.2;">
            <a class="text-decoration-none link-dark"
                href="{{ route('products.show', ['productType' => $product->subcategory->productType, 'category' => $product->subcategory->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}"
                property="name" itemprop="name">
                {{ Illuminate\Support\Str::limit($product->name, 60) }}
            </a>
        </div>

        <meta property="brand" itemprop="brand" content="БРИКС" />
        <meta property="category" itemprop="category" content="{{ $product->subcategory->name ?? 'Кирпич' }}" />
        <meta property="description" itemprop="description"
            content="{{ strip_tags($product->short_description ?? $product->name) }}" />

        @php
            $hasPiece = isset($product->price_per_piece);
            $hasPieceDiscount = isset($product->discount_price_per_piece);
            $hasSqm = isset($product->price_sqm);
            $hasSqmDiscount = isset($product->discount_price_sqm);
            $hasM3 = isset($product->price_m3);
            $hasM3Discount = isset($product->discount_price_m3);
        @endphp

        <div class="mt-auto" property="offers" typeof="Offer" itemprop="offers" itemscope
            itemtype="https://schema.org/Offer">
            @if ($hasPiece || $hasSqm || $hasM3)
                @if ($hasPiece)
                    <div class="price-wrapper">
                        @if ($hasPieceDiscount)
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->discount_price_per_piece }}">
                                    {{ number_format($product->discount_price_per_piece, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/шт</span>
                            </div>
                            <div>
                                <span class="old-price" property="price" content="{{ $product->price_per_piece }}">
                                    {{ number_format($product->price_per_piece, 0, ',', ' ') }} ₽
                                    <span class="price-units">/шт</span>
                                </span>
                            </div>
                        @else
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->price_per_piece }}">
                                    {{ number_format($product->price_per_piece, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/шт</span>
                            </div>
                        @endif
                        <meta property="priceCurrency" itemprop="priceCurrency" content="RUB" />
                        <link property="availability" itemprop="availability" href="https://schema.org/InStock" />
                    </div>
                @endif

                @if ($hasSqm)
                    <div class="price-wrapper">
                        @if ($hasSqmDiscount)
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->discount_price_sqm }}">
                                    {{ number_format($product->discount_price_sqm, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/м²</span>
                            </div>
                            <div>
                                <span class="old-price" property="price" content="{{ $product->price_sqm }}">
                                    {{ number_format($product->price_sqm, 0, ',', ' ') }} ₽
                                    <span class="price-units">/м²</span>
                                </span>
                            </div>
                        @else
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->price_sqm }}">
                                    {{ number_format($product->price_sqm, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/м²</span>
                            </div>
                        @endif
                        <meta property="priceCurrency" itemprop="priceCurrency" content="RUB" />
                        <link property="availability" itemprop="availability" href="https://schema.org/InStock" />
                    </div>
                @endif

                @if ($hasM3)
                    <div class="price-wrapper">
                        @if ($hasM3Discount)
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->discount_price_m3 }}">
                                    {{ number_format($product->discount_price_m3, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/м³</span>
                            </div>
                            <div>
                                <span class="old-price" property="price" content="{{ $product->price_m3 }}">
                                    {{ number_format($product->price_m3, 0, ',', ' ') }} ₽
                                    <span class="price-units">/м³</span>
                                </span>
                            </div>
                        @else
                            <div>
                                <span class="new-price price-amount" property="price"
                                    content="{{ $product->price_m3 }}">
                                    {{ number_format($product->price_m3, 0, ',', ' ') }} ₽
                                </span>
                                <span class="price-units">/м³</span>
                            </div>
                        @endif
                        <meta property="priceCurrency" itemprop="priceCurrency" content="RUB" />
                        <link property="availability" itemprop="availability" href="https://schema.org/InStock" />
                    </div>
                @endif
            @else
                <div class="price-wrapper">
                    <span class="new-price">По запросу</span>
                    <link property="availability" itemprop="availability" href="https://schema.org/PreOrder" />
                </div>
            @endif
        </div>

        <div class="action-icons">
            @if ($inComparison)
                <a class="fas fa-chart-simple icon active text-decoration-none text-warning" title="Убрать из сравнения"
                    wire:click="deleteFromComparison"></a>
            @else
                <i class="fas fa-chart-simple icon" title="Добавить в сравнение" wire:click="addToComparison"></i>
            @endif

            @if ($inFavorites)
                <a class="far fa-heart icon favorite active text-decoration-none text-danger"
                    title="Убрать из избранного" wire:click="deleteFromFavorites"></a>
            @else
                <i class="far fa-heart icon favorite" title="Добавить в избранное" wire:click="addToFavorites"></i>
            @endif
        </div>

        @if (
            $product->is_new ||
                $product->is_hit_of_sales ||
                (isset($product->price_per_piece) && isset($product->discount_price_per_piece)))
            <div class="product-labels">
                @if ($product->is_new)
                    <div class="badge text-bg-secondary">Новинка</div>
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
    @if ($quantity)
        <a class="btn btn-outline-primary mt-2 border-3 border-box text-decoration-none cart-button cart-button-active"
            href="{{ route('cart') }}">
            <i class="fas fa-shopping-cart icon" title="В корзине"></i> В корзине
        </a>
    @else
        <button class="btn btn-primary mt-2 border-3 cart-button" wire:click="addToCart">
            <i class="fas fa-shopping-cart icon" title="В корзину"></i> В корзину
        </button>
    @endif
</div>
