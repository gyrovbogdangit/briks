<div>
    @if ($products->count())
        <div class="list-group mb-4">
            @foreach ($products as $product)
                <div
                    class="list-group-item p-3 mb-3 rounded-3 shadow-sm d-flex flex-column flex-md-row align-items-center gap-3">
                    <a class="flex-shrink-0 d-block rounded-3 overflow-hidden bg-light"
                        style="width: 100px; height: 100px;"
                        href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
                        <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
                            alt="{{ $product->name }}" class="img-fluid h-100 w-100 object-fit-cover">
                    </a>
                    <div class="flex-grow-1 w-100">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-2">
                            <a class="fw-bold fs-5 text-primary text-decoration-none"
                                href="{{ route('products.show', ['productType' => $product->category->productType, 'category' => $product->category, 'subcategory' => $product->subcategory, 'product' => $product]) }}">
                                {{ $product->name }}
                            </a>
                            <div>
                                <div class="d-flex align-items-center gap-2 justify-content-end">
                                    @if (isset($product->discount_price_sqm))
                                        <span
                                            class="fs-5 fw-bold text-danger">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}₽/м²</span>
                                        <span
                                            class="text-muted text-decoration-line-through">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽/м²</span>
                                        <span
                                            class="badge bg-danger ms-2">-{{ floor(100 - ($product->discount_price_sqm / $product->price_sqm) * 100) }}%</span>
                                    @elseif (isset($product->price_sqm))
                                        <span
                                            class="fs-5 fw-bold">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽/м²</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-end">
                                    @if (isset($product->discount_price_per_piece))
                                        <span
                                            class="fs-5 fw-bold text-danger">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                        <span
                                            class="text-muted text-decoration-line-through">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                        <span
                                            class="badge bg-danger ms-2">-{{ floor(100 - ($product->discount_price_per_piece / $product->price_per_piece) * 100) }}%</span>
                                    @elseif (isset($product->price_per_piece))
                                        <span
                                            class="fs-5 fw-bold">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                            <div class="input-group input-group-sm w-auto" style="height: 34px;">
                                <button class="btn btn-outline-secondary py-1 px-2 rounded-start-3"
                                    wire:click.throttle.100ms="decrement({{ $product->id }}, '{{ $product->unit }}')"
                                    type="button"><i class="fa-solid fa-minus"></i></button>
                                <input type="text"
                                    class="form-control text-center border border-secondary fw-semibold py-1 px-2 "
                                    value="{{ $product->quantity }}" min="1" max="100" readonly
                                    style="width: 60px;">
                                <button class="btn btn-outline-secondary py-1 px-2 rounded-end-3"
                                    wire:click.throttle.100ms="increment({{ $product->id }}, '{{ $product->unit }}')"
                                    type="button"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <select class="form-select form-select-sm w-auto ms-2 py-1 px-2 rounded-3 border-secondary"
                                style="min-width: 60px; max-width: 90px;height:34px;"
                                wire:change="changeUnit({{ $product->id }}, $event.target.value)">
                                @if (isset($product->price_per_piece) || isset($product->discount_price_per_piece))
                                    <option value="piece" @if ($product->unit === 'piece') selected @endif>шт</option>
                                @endif
                                @if (isset($product->price_sqm) || isset($product->discount_price_sqm))
                                    <option value="sqm" @if ($product->unit === 'sqm') selected @endif>м²</option>
                                @endif
                            </select>
                            <button class="border border-secondary rounded-3 py-1 px-2 btn-sm ms-2 bg-light"
                                wire:click="delete({{ $product->id }}, '{{ $product->unit }}')">
                                <i class="fa fa-trash text-danger me-1"></i> Удалить
                            </button>
                        </div>
                        <div class="">
                            <span class="fw-semibold">Сумма: </span>
                            <span class="fw-bold text-primary">
                                @if ($product->unit === 'sqm')
                                    @php $price = $product->discount_price_sqm ?? $product->price_sqm; @endphp
                                    {{ number_format($price * $product->quantity, 0, ',', ' ') }}₽ за
                                    {{ $product->quantity }} м²
                                @else
                                    @php $price = $product->discount_price_per_piece ?? $product->price_per_piece; @endphp
                                    {{ number_format($price * $product->quantity, 0, ',', ' ') }}₽ за
                                    {{ $product->quantity }} шт
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="rounded-3 bg-white shadow-sm p-4 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="fs-4 fw-bold text-primary">
                    Всего: {{ number_format($totalSum, 0, ',', ' ') }}₽
                    <span class="fs-6 text-secondary">({{ $totalQuantity }}
                        {{ trans_choice('товар|товара|товаров', $totalQuantity, [], 'ru') }})</span>
                </div>
                <button class="btn btn-primary btn-lg px-4" data-fancybox data-src="#request-cart">
                    <i class="fa fa-paper-plane me-2"></i>Оставить заявку
                </button>
            </div>
        </div>
    @else
        <div class="rounded-3 bg-white shadow-sm  text-center py-5 rounded-3 shadow-sm">
            <p class="mb-2 fs-4">Ваша корзина пока что пуста!</p>
            <p class="mb-0">Вы можете добавить в неё новые товары из <a href="{{-- {{ route('catalog') }} --}}"
                    class="fw-bold text-primary">каталога</a>!</p>
        </div>
    @endif
</div>
