@if ($filter->attributes->isNotEmpty() || $filter->priceRange)
    <div class="d-flex justify-content-start gap-3 align-items-center flex-wrap rounded-3">
        @foreach ($filter->attributes as $attribute)
            @foreach ($attribute->values as $value)
                <a href="{{ route('products.index', [
                    'productType' => $type->slug,
                    'category' => $filter->category,
                    'subcategory' => $filter->subcategory,
                    ...$filter->queryWithoutAttributeValue($attribute->slug, $value->slug),
                ]) }}"
                    class="text-decoration-none fw-semibold rounded-3 bg-white text-dark shadow-sm px-3 py-2"
                    title="Убрать фильтр: {{ $attribute->name }}: {{ $value->value }}">
                    <span><span class="text-light-emphasis">{{ $attribute->name }}</span>: {{ $value->value }}</span>
                    <i class="fas fa-times ms-1 small text-light-emphasis"></i>
                </a>
            @endforeach
        @endforeach

        @if ($filter->priceRange)
            <a href="{{ route('products.index', [
                'productType' => $type->slug,
                'category' => $filter->category,
                'subcategory' => $filter->subcategory,
                ...$filter->queryAttributes(),
            ]) }}"
                class="text-decoration-none fw-semibold text-primary rounded-3 bg-white text-dark shadow-sm  px-3 py-2"
                title="Убрать фильтр по цене">
                <span>Цена: {{ $filter->priceRange[0] }}–{{ $filter->priceRange[1] }} ₽</span>
                <i class="fas fa-times ms-1 small text-light-emphasis"></i>
            </a>
        @endif

        @if ($filter->filtersExists())
            <a class="text-decoration-none fw-semibold text-primary rounded-3 bg-white text-dark shadow-sm px-3 py-2"
                href="{{ route('products.index', ['productType' => $type, 'category' => $filter->category, 'subcategory' => $filter->subcategory]) }}"
                title="Сбросить все фильтры">
                <span>Сбросить все</span>
                <i class="fas fa-trash-alt ms-1 text-light-emphasis"></i>
            </a>
        @endif
    </div>
@endif
