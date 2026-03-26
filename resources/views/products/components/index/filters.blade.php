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
                            <ul class="collapse list-group ms-3 mt-2 {{ $filter->category->slug === $category->slug ? 'show' : '' }}"
                                id="category-{{ $category->slug }}-subcategories">
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
                                @php $values = $attribute->values->values(); @endphp
                                @foreach ($values as $i => $value)
                                    <li
                                        class="list-group-item p-0 border-0 bg-transparent @if ($i >= 5) d-none more-values-{{ $attribute->id }} @endif">
                                        <div class="form-check d-flex">
                                            @if ($value->color)
                                                <div class="border-light border"
                                                    style="width: 22px; height:22px; border-radius: 100%; background-color: {{ $value->color }}; position: absolute; left: -10px;">
                                                </div>
                                            @endif
                                            <input type="checkbox"
                                                class="form-check-input filter-checkbox  @if ($value->color) ms-1 @endif me-2"
                                                name="{{ $attribute->slug }}[]" value="{{ $value->slug }}"
                                                id="filter-{{ $attribute->id }}-{{ $value->id }}"
                                                @if ($value->products_count === 0) disabled @endif
                                                data-filter-id="{{ $value->slug }}" @checked($filter->inAttributeValues($attribute->slug, $value->slug)) />

                                            <label class="form-check-label"
                                                for="filter-{{ $attribute->id }}-{{ $value->id }}">{{ $value->value }}</label>
                                            @isset($value->products_count)
                                                <span class="text-muted ms-1">({{ $value->products_count }})</span>
                                            @endisset
                                        </div>
                                    </li>
                                @endforeach
                                @if ($values->count() > 5)
                                    <li class="list-group-item p-0 border-0 bg-transparent">
                                        <button class="btn btn-link btn-sm px-0 show-more-values-btn" type="button"
                                            data-attribute-id="{{ $attribute->id }}">
                                            Показать все
                                        </button>
                                        <button class="btn btn-link btn-sm px-0 hide-more-values-btn d-none"
                                            type="button" data-attribute-id="{{ $attribute->id }}">
                                            Скрыть
                                        </button>
                                    </li>
                                @endif
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
