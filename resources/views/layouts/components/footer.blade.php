<footer class="bg-dark text-light py-4 mt-5 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="fw-bold fs-5">О компании</div>
                <p class="small fw-semibold">
                    БРИКС — ведущий поставщик облицовочных материалов. Мы предлагаем
                    широкий ассортимент качественных товаров для строительства и
                    ремонта.
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <div class="fw-bold fs-5">Быстрые ссылки</div>
                <ul class="list-unstyled fw-semibold">
                    @foreach ($pages as $page)
                        <li>
                            <a href="{{ route('page', ['page' => $page]) }}"
                                class="text-light text-decoration-none">{{ $page->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <div class="fw-bold fs-5">Контакты</div>
                <ul class="list-unstyled fw-semibold">
                    <li>
                        <i class="fas fa-map-marker-alt me-2"></i> <a href="tel:{{ $addresses[0]->url }}"
                            class="link-light text-decoration-none">{{ $addresses[0]->address }}</a>
                    </li>
                    <li><i class="fas fa-phone me-2"></i><a href="tel:{{ $phoneNumbers[0]->number }}"
                            class="link-light text-decoration-none">{{ $phoneNumbers[0]->number }}</a></li>
                    <li><i class="fas fa-envelope me-2"></i><a href="mailto:{{ $emails[0]->email }}"
                            class="link-light text-decoration-none">{{ $emails[0]->email }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="bg-light" />
        <div class="text-center small">
            &copy; 2025 БРИКС. Все права защищены. Не является публичной офертой.
        </div>
    </div>
</footer>
