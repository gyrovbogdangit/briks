<div class="mb-2">
    <div class="fw-bold mb-1">{{ $product->name }}</div>
    @isset($product->article)
        <div class="d-flex align-items-center gap-2 small text-muted">
            <span>Артикул:</span>
            <span class="fw-semibold text-dark">{{ $product->article }}</span>
        </div>
    @endisset
</div>
