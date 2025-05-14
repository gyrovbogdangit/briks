<nav id="catalog-menu" class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="catalogMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="catalogMenuLabel">Каталог</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="list-group list-group-flush">
            @foreach ($types as $type)
                <li class="list-group-item px-0">
                    <a class="d-flex justify-content-between align-items-center text-decoration-none w-100"
                        data-bs-toggle="collapse" href="#collapse-type-{{ $type->id }}" role="button"
                        aria-expanded="false" aria-controls="collapse-type-{{ $type->id }}">
                        <span>{{ $type->name }}</span>
                        @if (!empty($type->categories))
                            <span class="ms-2"><i class="bi bi-chevron-right"></i></span>
                        @endif
                    </a>
                    @if (!empty($type->categories))
                        <div class="collapse ms-3" id="collapse-type-{{ $type->id }}">
                            <ul class="list-group list-group-flush">
                                @foreach ($type->categories as $category)
                                    <li class="list-group-item px-0">
                                        <a class="d-flex justify-content-between align-items-center text-decoration-none w-100"
                                            data-bs-toggle="collapse" href="#collapse-category-{{ $category->id }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="collapse-category-{{ $category->id }}">
                                            <span>{{ $category->name }}</span>
                                            @if (!empty($category->subcategories))
                                                <span class="ms-2"><i class="bi bi-chevron-right"></i></span>
                                            @endif
                                        </a>
                                        @if (!empty($category->subcategories))
                                            <div class="collapse ms-3" id="collapse-category-{{ $category->id }}">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li class="list-group-item px-0">
                                                            <a href="{{ route('products.index', ['productType' => $type['slug'], 'category' => $category->slug, 'subcategory' => $subcategory['slug']]) }}"
                                                                class="text-decoration-none">
                                                                {{ $subcategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
