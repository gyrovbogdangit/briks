<div class="me-3">
    <a href="#" class="text-decoration-none d-inline-flex align-items-center city-name" data-bs-toggle="modal"
        data-bs-target="#city">
        <i class="fas fa-map-marker-alt me-1"></i> Ваш город:
        <span class="fw-bold ms-1">
            @if ($city)
                {{ $city }}
            @else
                Неизвестно
            @endif
        </span>
    </a>
</div>
