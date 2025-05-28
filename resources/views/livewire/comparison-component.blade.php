<div>
    @if (count($categories))
        <ul class="nav nav-tabs flex-nowrap border-0 justify-content-center" style="white-space:nowrap;">
            @foreach ($categories as $i => $category)
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if ($i === 0) active @endif fw-semibold text-primary"
                        data-bs-toggle="tab" href="#category-{{ $category->slug }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content bg-white shadow-sm rounded-3 p-3 border">
            @foreach ($categories as $i => $category)
                <div id="category-{{ $category->slug }}"
                    class="tab-pane fade @if ($i === 0) show active @endif">
                    <div class="table-responsive rounded-3">
                        <table class="table align-middle bg-white">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-secondary fw-semibold" style="min-width:180px;">Характеристика</th>
                                    @foreach ($category->products as $product)
                                        <th class="text-center align-top" style="min-width:220px;">
                                            <a href="{{ route('products.show', [
                                                'productType' => $product->category->productType,
                                                'category' => $product->category,
                                                'subcategory' => $product->subcategory,
                                                'product' => $product,
                                            ]) }}"
                                                class="text-decoration-none text-dark">
                                                <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
                                                    alt="" class="img-fluid rounded-3 mb-2"
                                                    style="max-height:90px;">
                                                <div class="fw-bold small lh-sm">{{ $product->name }}</div>
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->attributes as $attribute)
                                    <tr>
                                        <th class="bg-light text-secondary fw-semibold">{{ $attribute->name }}</th>
                                        @foreach ($category->products as $product)
                                            <td>{{ $product->attributeValues->where('attribute.id', $attribute->id)->first()->value->value ?? '-' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <th class="bg-light text-secondary fw-semibold">Цена за 1 шт / 1 м²</th>
                                    @foreach ($category->products as $product)
                                        <td class="text-center">
                                            @php
                                                $hasPiece = isset($product->price_per_piece);
                                                $hasPieceDiscount = isset($product->discount_price_per_piece);
                                                $hasSqm = isset($product->price_sqm);
                                                $hasSqmDiscount = isset($product->discount_price_sqm);
                                            @endphp
                                            @if ($hasPiece)
                                                <div>
                                                    @if ($hasPieceDiscount)
                                                        <span
                                                            class="fs-6 fw-bold text-danger">{{ number_format($product->discount_price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                                        <span
                                                            class="text-muted text-decoration-line-through small ms-1">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                                    @else
                                                        <span
                                                            class="fs-6 fw-bold text-primary">{{ number_format($product->price_per_piece, 0, ',', ' ') }}₽/шт</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if ($hasSqm)
                                                <div>
                                                    @if ($hasSqmDiscount)
                                                        <span
                                                            class="fs-6 fw-bold text-danger">{{ number_format($product->discount_price_sqm, 0, ',', ' ') }}₽/м²</span>
                                                        <span
                                                            class="text-muted text-decoration-line-through small ms-1">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽/м²</span>
                                                    @else
                                                        <span
                                                            class="fs-6 fw-bold text-primary">{{ number_format($product->price_sqm, 0, ',', ' ') }}₽/м²</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if (!$hasPiece && !$hasSqm)
                                                <span class="text-muted">По запросу</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="bg-light"></th>
                                    @foreach ($category->products as $product)
                                        <td class="text-center">
                                            <button
                                                class="border border-secondary rounded-3 py-1 px-2 btn-sm ms-2 bg-light"
                                                wire:click="delete({{ $product->id }})">
                                                <i class="fa fa-trash text-danger me-1"></i> Удалить
                                            </button>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-5 rounded-3 shadow-sm">
            <p class="mb-2 fs-4">Страница сравнений пока что пуста!</p>
            <p class="mb-0">Вы можете добавить в неё новые товары из <a href="{{ route('catalog') }}"
                    class="fw-bold text-primary">каталога</a>!</p>
        </div>
    @endif
</div>
