<div class="flex-grow-1 mx-0 mx-lg-3 order-3 order-lg-2">
    <div class="position-relative d-flex align-items-center w-100">
        <input type="text" id="search-input"
            class="search-input big-search rounded-2 border border-2 border-gray fw-semibold w-100" placeholder="Поиск..."
            wire:model.live="search" />
        <i class="fas fa-search search-icon"></i>
        @if (isset($products))
            <div class="search-results position-absolute bg-white border rounded-2 shadow-sm mt-3 z-3 w-100">
                <ul class="list-group list-group-flush">
                    @if (count($products))
                        @foreach ($products as $product)
                            <li class="list-group-item px-3 py-2 d-flex align-items-center gap-2">
                                <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
                                    alt="{{ $product->name }}" class="rounded-2">
                                <a href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product->slug]) }}"
                                    class="text-decoration-none text-dark fw-semibold d-block">
                                    {{ $product->name }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item px-3 py-2 text-muted">
                            По вашему запросу ничего не найдено
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</div>
