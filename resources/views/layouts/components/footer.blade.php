<footer class="bg-white border-top border-light-subtle pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-12">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <a class="navbar-brand flex-shrink-0 me-2" href="{{ route('home') }}" rel="home">
                        <img src="{{ asset('img/logo.webp') }}" width="139" height="36"
                            alt="БРИКС — строительные материалы" aria-label="БРИКС — строительные материалы">
                    </a>
                </div>
                <div class="text-dark fw-bold fs-5 mb-4">О компании</div>
                <p class="text-muted lh-lg fw-medium mb-4" style="max-width: 360px;">
                    БРИКС — ведущий поставщик облицовочных материалов. Мы предлагаем широкий ассортимент качественных
                    товаров для строительства и ремонта. </p>
                {{-- <div class="d-flex gap-2">
                    <a class="footer-social-btn" href="#"><i class="fas fa-share-nodes"></i></a>
                    <a class="footer-social-btn" href="#"><i class="fas fa-comments"></i></a>
                </div> --}}
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="text-dark fw-bold fs-5 mb-4">Каталог</div>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    @foreach ($types as $type)
                        <li>
                            <a href="{{ route('product-types.show', ['productType' => $type]) }}"
                                class="text-muted text-decoration-none footer-link">
                                {{ $type->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="text-dark fw-bold fs-5 mb-4">Компания</div>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    @foreach ($pages as $page)
                        <li>
                            <a href="{{ route('page', ['page' => $page]) }}"
                                class="text-muted text-decoration-none footer-link">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="text-dark fw-bold fs-5 mb-4">Контакты</div>
                <ul class="list-unstyled d-flex flex-column gap-4">
                    <li class="d-flex align-items-start gap-3">
                        <i class="fas fa-phone text-primary mt-1"></i>
                        <div>
                            <a href="tel:{{ $phoneNumbers[0]->number }}"
                                class="text-dark fw-bold text-decoration-none fs-6">
                                {{ $phoneNumbers[0]->number }}
                            </a>
                            <div class="text-muted small">Ежедневно с 9:00 до 18:00</div>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3">
                        <i class="fas fa-envelope text-primary mt-1"></i>
                        <a href="mailto:{{ $emails[0]->email }}"
                            class="text-muted text-decoration-none footer-link fw-semibold">
                            {{ $emails[0]->email }}
                        </a>
                    </li>
                    <li class="d-flex align-items-start gap-3 text-muted fw-semibold">
                        <i class="fas fa-location-dot text-primary mt-1"></i>
                        <a href="{{ $addresses[0]->url }}" rel="noopener noreferrer" target="_blank" itemprop="address"
                            class="text-decoration-none footer-link text-muted fw-semibold">
                            </i> {{ $addresses[0]->address }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-top border-light-subtle" style="font-size: 13px;">
        <div
            class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 text-muted">
            <p class="mb-0">© 2024 БРИКС. Все права защищены. Не является публичной офертой.</p>
            <div class="d-flex gap-4">
                <a href="{{ route('privacy') }}" class="text-muted text-decoration-none footer-link">Политика
                    конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>
