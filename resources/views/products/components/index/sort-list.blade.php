<div class="d-flex flex-wrap align-items-center gap-2">
    <span class="fw-semibold">{{ $sortTitle }}:</span>
    @foreach ($sortList as $name => $slug)
        @php
            $query = $originalQuery;
            $query['page'] = 1;
            $query[$sortSlug] = $slug;
        @endphp
        <a class="text-secondary text-decoration-none fw-semibold"
            {{ $filter->$attr == $slug ? 'sort-list__item--active' : '' }}"
            href="{{ route('products.index', [
                'productType' => $type,
                'category' => $category,
                'subcategory' => $subcategory,
                ...$query,
            ]) }}">
            {{ $name }}
        </a>
        @if (!$loop->last)
            <span class="text-muted">/</span>
        @endif
    @endforeach
</div>
