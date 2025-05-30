<div class="filters-sidebar bg-white rounded-3 p-3 fw-semibold shadow-sm">
    <form>
        <h2 class="fs-4 mb-3">Фильтры</h2>
        <div class="categories">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item p-0 border-0 bg-transparent">
                        <a class="category-link d-block px-2 py-1 fw-bold position-relative {{ $filter->category->slug === $category->slug ? 'active-category' : '' }}"
                            data-bs-toggle="collapse" href="#category-{{ $category->slug }}-subcategories" role="button"
                            aria-expanded="{{ $filter->category->slug === $category->slug ? 'true' : 'false' }}"
                            aria-controls="category-{{ $category->slug }}-subcategories">
                            {{ $category->name }}
                        </a>
                        @if (count($category->subcategories))
                            <ul
                                class="collapse list-group ms-3 {{ $filter->category->slug === $category->slug ? 'show' : '' }}">
                                @foreach ($category->subcategories as $subcategory)
                                    <li class="list-group-item p-0 border-0 bg-transparent">
                                        <a class="subcategory-link text-decoration-none d-block px-2 py-1 position-relative {{ $subcategory->slug === $filter->subcategory->slug ? 'active-subcategory' : '' }}"
                                            href="{{ route('products.index', ['productType' => $type, 'category' => $category, 'subcategory' => $subcategory]) }}">
                                            {{ $subcategory->name }}
                                            <span class="text-muted">({{ $subcategory->products_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <hr />

        <div class="attributes">
            <ul class="list-group">
                @foreach ($attributes as $attribute)
                    @if (count($attribute->values) > 1)
                        <li class="list-group-item ">
                            <a class="category-link" data-bs-toggle="collapse" href="#attributes{{ $attribute->id }}"
                                role="button" aria-expanded="true" aria-controls="attributes">
                                {{ $attribute->name }}
                            </a>
                            <ul class="collapse list-group ms-3 mt-2 show" id="attributes{{ $attribute->id }}">
                                @foreach ($attribute->values as $value)
                                    <li class="list-group-item p-0 border-0 bg-transparent">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input filter-checkbox me-2"
                                                name="{{ $attribute->slug }}[]" value="{{ $value->slug }}"
                                                id="filter-{{ $attribute->id }}-{{ $value->id }}"
                                                data-filter-id="{{ $value->slug }}" @checked($filter->inAttributeValues($attribute->slug, $value->slug))
                                                @disabled($value->products_count === 0) />
                                            <label class="form-check-label"
                                                for="filter-{{ $attribute->id }}-{{ $value->id }}">{{ $value->value }}</label>
                                            <span class="text-muted ms-1">({{ $value->products_count }})</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <hr />
                    @endif
                @endforeach
            </ul>
        </div>
        <button class="btn btn-primary w-100 fw-bolder">Применить фильтры</button>
    </form>
</div>
