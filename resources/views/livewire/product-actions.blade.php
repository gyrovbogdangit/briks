<div class="card shadow-sm mb-3">
    <div class="card-body">
        @if (isset($product->price_per_piece) || isset($product->price_sqm))
            <div class="mb-3">
                <form class="d-flex align-items-center gap-2" wire:submit="addToCart">
                    @isset($quantity)
                        <a class="btn btn-success flex-grow-1" href="{{ route('cart') }}">
                            В корзине
                        </a>
                    @else
                        <input type="number" class="form-control w-auto" placeholder="1 шт" wire:model="quantity">
                        <button class="btn btn-primary flex-grow-1" type="button" data-id="{{ $product->id }}"
                            wire:click="addToCart">
                            В корзину
                        </button>
                    @endisset
                </form>
                <button class="btn btn-outline-secondary w-100 mt-2" type="button" data-fancybox
                    data-src="#order-one-click{{ $product->id }}">
                    Заказать в 1 клик
                </button>
            </div>
        @else
            <div class="mb-3">
                <div class="d-flex align-items-center gap-2">
                    <input type="number" class="form-control w-auto" placeholder="1 шт">
                    <button class="btn btn-primary flex-grow-1" type="button" data-fancybox
                        data-src="#order{{ $product->id }}">
                        Запросить стоимость
                    </button>
                </div>
                <button class="btn btn-outline-secondary w-100 mt-2" type="button" data-fancybox
                    data-src="#order-one-click{{ $product->id }}">
                    Заказать в 1 клик
                </button>
            </div>
        @endif
        <div class="d-flex gap-2 mt-3">
            @if ($inFavorites)
                <a class="btn btn-outline-danger flex-fill" href="{{-- {{ route('favorites') }} --}}">
                    <i class="fas fa-heart me-1"></i> В избранном
                </a>
            @else
                <button class="btn btn-outline-danger flex-fill" type="button" wire:click="addToFavorites">
                    <i class="far fa-heart me-1"></i> В избранное
                </button>
            @endif
            @if ($inComparison)
                <a class="btn btn-outline-primary flex-fill" href="{{ route('comparison') }}">
                    <i class="fas fa-balance-scale me-1"></i> В сравнении
                </a>
            @else
                <button class="btn btn-outline-primary flex-fill" type="button" wire:click="addToComparison">
                    <i class="fas fa-balance-scale me-1"></i> Сравнение
                </button>
            @endif
        </div>
    </div>
</div>
