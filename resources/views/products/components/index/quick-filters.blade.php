@if ($quickFilters->isNotEmpty())
    <div class="d-flex justify-content-start gap-3 align-items-center overflow-x-auto pb-1 fancy-thumb-scroll w-100"
        style="max-width: calc(100vw - 50px);" style="min-width:0;">
        @foreach ($quickFilters as $quickFilter)
            <a href="{{ route('products.index', ['productType' => $type, 'category' => $quickFilter->category, 'subcategory' => $quickFilter->subcategory, $quickFilter->attribute->slug . '[]' => $quickFilter->value->slug]) }}"
                class="fw-semibold rounded-3 shadow-sm px-3 py-2 bg-white link-underline-primary link-underline link-underline-opacity-50 link-offset-1 quick-filter
                {{ $filter->inAttributeValues($quickFilter->attribute->slug, $quickFilter->value->slug) ? 'text-primary' : ' text-dark' }}">
                {{ $quickFilter->name }}</a>
        @endforeach
    </div>
@endif
