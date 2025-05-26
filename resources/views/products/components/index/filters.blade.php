<div class="filters-sidebar col-md-3" style="height: 100%">
    <div>
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
                        <li class="list-group-item {{ $filter->attributeExists($attribute->slug) ? 'show' : '' }}">
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

            {{--   <div class="filters scroll">
            @foreach ($attributes as $attribute)
                @if (count($attribute->values) > 1)
                    <div class="filters__item {{ $filter->attributeExists($attribute->slug) ? 'active' : '' }}">
                        <div class="filters__title">
                            <div style="width:90%">{{ $attribute->name }}</div>
                        </div>
                        <div class="filters__list filters-list">
                            @foreach ($attribute->values as $value)
                                <label class="filters-list__item">
                                    <input type="checkbox" class="filters-list__checkbox"
                                        name="{{ $attribute->slug }}[]" value="{{ $value->slug }}"
                                        id="filter-{{ $attribute->id }}-{{ $value->id }}"
                                        data-filter-id="{{ $value->slug }}" @checked($filter->inAttributeValues($attribute->slug, $value->slug))
                                        @disabled($value->products_count === 0)>
                                    <span class="filters-list__txt">{{ $value->value }} <span
                                            class="filters-list__numbs">({{ $value->products_count }})</span></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
 --}}
            {{--  @if ($maxPrice && $maxPrice !== $minPrice)
                <div class="filters__item filters__item--prices">
                    <div class="filters__title">Цена, руб.</div>
                    <div class="filters__block">
                        <div class="filters-range" id="slider-range" data-min="{{ $minPrice }}"
                            data-max="{{ $maxPrice }}"></div>
                        <div class="filters__prices prices-inputs">
                            <div class="prices-inputs__input">
                                <input type="number" class="slider-value" id="min-price" data-index="0"
                                    name="min-price" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                    value="{{ $filter->priceRange ? $filter->priceRange['0'] : $minPrice }}"
                                    placeholder=" ">
                                <label for="min-price">От</label>
                            </div>
                            <div class="prices-inputs__input">
                                <input type="number" class="slider-value" id="max-price" data-index="1"
                                    name="max-price" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                    value="{{ $filter->priceRange ? $filter->priceRange['1'] : $maxPrice }}"
                                    placeholder=" ">
                                <label for="max-price">До</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
        <button class="btn btn-primary btn-show mt-3 w-100">Применить фильтры</button>
    </div>
</div>
