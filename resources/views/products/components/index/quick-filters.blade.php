@if ($quickFilters->isNotEmpty())
    <div class="d-flex justify-content-start gap-3 align-items-center flex-wrap rounded-3">
        @foreach ($quickFilters as $quickFilter)
            <a href="{{ route('products.index', ['productType' => $type, 'category' => $quickFilter->category, 'subcategory' => $quickFilter->subcategory, $quickFilter->attribute->slug . '[]' => $quickFilter->value->slug]) }}"
                class="fw-semibold rounded-3 shadow-sm px-3 py-2 bg-white text-decoration-none
                {{ $filter->inAttributeValues($quickFilter->attribute->slug, $quickFilter->value->slug) ? 'text-primary' : ' text-dark' }}">
                {{ $quickFilter->name }}</a>
        @endforeach
    </div>
@endif
