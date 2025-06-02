<div class="modal fade" id="order-one-click{{ $product->id }}" tabindex="-1"
    aria-labelledby="orderOneClickLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderOneClickLabel{{ $product->id }}">Заказать в один клик</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body p-0">
                <livewire:modal-order-one-click :product="$product" />
            </div>
        </div>
    </div>
</div>
