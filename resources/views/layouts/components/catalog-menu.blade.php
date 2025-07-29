<nav id="catalog-menu" class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="catalogMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="catalogMenuLabel"><a href="{{ route('catalog') }}"
                class="text-decoration-none text-dark">Каталог</h5></a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="catalog-mega-menu d-none d-lg-flex">
            <ul class="catalog-types list-group border-end">
                @foreach ($types as $type)
                    <li class="list-group-item px-3 py-2 border-0 catalog-type-item position-relative">
                        <a href="{{ route('product-types.show', ['productType' => $type]) }}"
                            class="text-decoration-none d-block w-100 catalog-type-link"
                            data-type-id="{{ $type->id }}">
                            {{ $type->name }}
                            <i class="fa-solid fa-chevron-right float-end mt-1"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            @foreach ($types as $type)
                @if (!empty($type->categories))
                    <div class="catalog-categories-menu" data-categories-for="{{ $type->id }}">
                        <ul class="catalog-categories list-group border-start border-end">
                            @foreach ($type->categories as $category)
                                <li class="list-group-item px-3 py-2 border-0 catalog-category-item">
                                    <a href="{{ route('categories.show', ['productType' => $type, 'category' => $category]) }}"
                                        class="text-decoration-none d-block w-100 catalog-category-link"
                                        data-category-id="{{ $category->id }}">
                                        {{ $category->name }}
                                        <i class="fa-solid fa-chevron-right float-end mt-1"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @foreach ($type->categories as $category)
                            @if (!empty($category->subcategories))
                                <div class="catalog-subcategories-menu" data-subcategories-for="{{ $category->id }}">
                                    <ul class="catalog-subcategories list-group">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li class="list-group-item px-3 py-2 border-0">
                                                <a href="{{ route('products.index', ['productType' => $type['slug'], 'category' => $category->slug, 'subcategory' => $subcategory['slug']]) }}"
                                                    class="text-decoration-none d-block w-100 catalog-subcategory-link">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
        <div class="d-block d-lg-none p-2">
            <ul class="list-group">
                @foreach ($types as $type)
                    <li class="list-group-item p-0 border-0">
                        <a class="d-block px-3 py-2 fw-bold text-decoration-none" data-bs-toggle="collapse"
                            href="#mobile-type-{{ $type->id }}" role="button" aria-expanded="false"
                            aria-controls="mobile-type-{{ $type->id }}">
                            {{ $type->name }}
                        </a>
                        @if (!empty($type->categories))
                            <ul class="collapse list-group ms-2" id="mobile-type-{{ $type->id }}">
                                @foreach ($type->categories as $category)
                                    <li class="list-group-item p-0 border-0">
                                        <a class="d-block px-3 py-2 text-decoration-none text-dark"
                                            data-bs-toggle="collapse" href="#mobile-cat-{{ $category->id }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="mobile-cat-{{ $category->id }}">
                                            {{ $category->name }}
                                        </a>
                                        @if (!empty($category->subcategories))
                                            <ul class="collapse list-group ms-2 show"
                                                id="mobile-cat-{{ $category->id }}">
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li class="list-group-item p-0 border-0">
                                                        <a href="{{ route('products.index', ['productType' => $type['slug'], 'category' => $category->slug, 'subcategory' => $subcategory['slug']]) }}"
                                                            class="d-block px-3 py-2 text-decoration-none text-dark">
                                                            {{ $subcategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
