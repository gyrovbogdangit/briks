<div class="mb-3">
    <div class="shadow-sm mb-2 bg-light rounded-3 p-3">
        <div class="mb-1">
            @if (isset($product->price_per_piece) || isset($product->price_sqm))
                <form class="d-flex align-items-center gap-2 flex-wrap" wire:submit="addToCart">
                    @isset($quantity)
                        <a class="btn btn-info btn-lg flex-grow-1" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart me-2"></i> В корзине
                        </a>
                    @else
                        <input type="number" class="form-control form-control-lg" placeholder="1" min="1"
                            wire:model="quantity" style="width:100px;">
                        <div class="btn-group btn-group-lg mb-2 mb-md-0" role="group" aria-label="Единица измерения">
                            <input type="radio" class="btn-check" name="unit" id="unit_piece{{ $product->id }}"
                                value="piece" autocomplete="off" wire:model="unit"
                                @if (!isset($product->price_per_piece)) disabled @endif
                                @if (isset($product->price_per_piece) && (!isset($product->price_sqm) || $unit === 'piece' || !isset($unit))) checked @endif>
                            <label class="btn btn-outline-info fw-bolder" for="unit_piece{{ $product->id }}">шт</label>
                            <input type="radio" class="btn-check" name="unit" id="unit_sqm{{ $product->id }}"
                                value="sqm" autocomplete="off" wire:model="unit"
                                @if (!isset($product->price_sqm)) disabled @endif
                                @if (isset($product->price_sqm) && (!isset($product->price_per_piece) || $unit === 'sqm')) checked @endif>
                            <label class="btn btn-outline-info fw-bolder" for="unit_sqm{{ $product->id }}">м²</label>
                        </div>
                        <button class="btn btn-lg btn-outline-info flex-grow-1 fw-bolder w-50" type="button"
                            data-id="{{ $product->id }}" wire:click="addToCart">
                            <i class="fa-solid fa-cart-plus me-2"></i>
                            В корзину
                        </button>
                    @endisset
                </form>
                <button class="btn btn-info w-100 mt-2 fw-semibold" type="button" data-bs-toggle="modal"
                    data-bs-target="#order-one-click{{ $product->id }}">
                    Заказать в 1 клик
                </button>
            @else
                <form class="d-flex align-items-center gap-2" wire:submit="addToCart">
                    @isset($quantity)
                        <a class="btn btn-info btn-lg flex-grow-1" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart me-2"></i> В корзине
                        </a>
                    @else
                        <input type="number" class="form-control form-control-lg w-50" placeholder="1" min="1"
                            wire:model="quantity">
                        <button class="btn btn-info btn-lg w-50" type="button" data-id="{{ $product->id }}"
                            wire:click="addToCart">
                            <i class="fa-solid fa-cart-plus me-2"></i> В корзину
                        </button>
                    @endisset
                </form>
                <div class="d-flex align-items-center gap-2 mt-3">
                    <button class="btn btn-info flex-grow-1 w-50" type="button" data-bs-toggle="modal"
                        data-bs-target="#requestPriceModal{{ $product->id }}">
                        Запросить стоимость
                    </button>
                    <button class="btn btn-info flex-grow-1 w-50" type="button" data-bs-toggle="modal"
                        data-bs-target="#order-one-click{{ $product->id }}">
                        Заказать в 1 клик
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex gap-4 justify-content-center mb-1 product-actions">
        @if ($inFavorites)
            <a class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                href="{{ route('favorites') }}">
                <i class="fas fa-bookmark me-1 text-primary"></i> В избранном
            </a>
        @else
            <a class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" type="button"
                wire:click="addToFavorites">
                <i class="fas fa-bookmark me-1"></i> В избранное
            </a>
        @endif
        @if ($inComparison)
            <a class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                href="{{ route('comparison') }}">
                <i class="fas fa-chart-simple me-1 text-primary"></i> В сравнении
            </a>
        @else
            <a class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" type="button"
                wire:click="addToComparison">
                <i class="fas fa-chart-simple me-1"></i> В сравнение
            </a>
        @endif
    </div>
</div>
