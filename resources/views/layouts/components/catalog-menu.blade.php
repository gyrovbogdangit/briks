<nav id="catalog-menu" class="offcanvas catalog-modal" tabindex="-1">
    <div class="offcanvas-header border-bottom py-3 px-4 d-lg-none">
        <h5 class="offcanvas-title fw-bold" id="catalogMenuLabel">
            <a href="{{ route('catalog') }}" class="text-decoration-none text-dark">Каталог материалов</a>
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body offcanvas-body-catalog p-0 ">
        <div class="catalog-mega-menu d-none d-lg-flex">
            <aside class="catalog-sidebar border-right border-light-subtle">
                <div class="sidebar-label px-4 pt-4 pb-2 text-uppercase fw-bold text-muted">
                    Категории
                </div>
                <ul class="list-unstyled flex-column gap-1 p-3">
                    @foreach ($types as $type)
                        <li>
                            <a class="catalog-type-btn w-100 border-0 d-flex align-items-center gap-3 text-decoration-none transition-all @if ($loop->first) active @endif"
                                href="{{ route('product-types.show', ['productType' => $type]) }}"
                                data-type-target="{{ $type->id }}">
                                @isset($type->image)
                                    <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}"
                                        class="type-icon">
                                @endisset
                                <span class="fw-semibold small">{{ $type->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <main class="catalog-content flex-grow-1 bg-white p-5">
                <div class="text-end position-absolute end-0 pe-5">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                @foreach ($types as $type)
                    <div class="catalog-pane @if (!$loop->first) d-none @endif"
                        id="pane-{{ $type->id }}">
                        <div class="pane-header mb-4">
                            <h2 class="fw-bold mb-2">{{ $type->name }}</h2>
                            <p class="text-muted" style="max-width: 32rem;">Широкий ассортимент кирпича для любых
                                строительных задач: от фундамента до декоративной отделки фасадов.</p>
                        </div>

                        <div class="row g-4">
                            @foreach ($type->categories as $category)
                                <div class="col-md-6 col-xl-4">
                                    <div class="category-group">
                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <span class="dot bg-primary"></span>
                                            <a href="{{ route('categories.show', ['productType' => $type, 'category' => $category]) }}"
                                                class="link-dark text-decoration-none">{{ $category->name }}</a>
                                        </h6>
                                        <ul class="list-unstyled d-flex flex-column gap-2 ms-3">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li>
                                                    <a href="{{ route('products.index', ['productType' => $type['slug'], 'category' => $category->slug, 'subcategory' => $subcategory['slug']]) }}"
                                                        class="subcategory-link text-decoration-none text-muted hover-primary">
                                                        {{ $subcategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </main>
        </div>

        <div class="d-block d-lg-none p-3 mb-5">
            <div class="accordion accordion-flush" id="mobileCatalog">
                @foreach ($types as $type)
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3 shadow-none bg-light fw-bold"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#mob-type-{{ $type->id }}">
                                @isset($type->image)
                                    <img src="{{ asset('storage/' . $type->image) }}" class="me-2"
                                        style="height:24px;margin-bottom:5px;">
                                @endisset
                                {{ $type->name }}
                            </button>
                        </h2>
                        <div id="mob-type-{{ $type->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#mobileCatalog">
                            <div class="accordion-body pe-2 ps-3">
                                @foreach ($type->categories as $category)
                                    <div class="mb-3">
                                        <div class="fw-bold mb-2"><a class="text-dark text-decoration-none"
                                                href="{{ route('categories.show', ['productType' => $type, 'category' => $category]) }}">{{ $category->name }}</a>
                                        </div>
                                        <div class="list-group list-group-flush ps-2">
                                            @foreach ($category->subcategories as $subcategory)
                                                <a href="{{ route('products.index', ['productType' => $type, 'category' => $category, 'subcategory' => $subcategory]) }}"
                                                    class="list-group-item list-group-item-action border-0 py-1 text-muted">
                                                    {{ $subcategory->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</nav>
