<!-- Bootstrap Modal for Request Price -->
<div class="modal fade" id="requestPriceModal{{ $product->id }}" tabindex="-1"
    aria-labelledby="requestPriceModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestPriceModalLabel{{ $product->id }}">Запросить стоимость</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body p-4">
                <livewire:modal-request-price :product="$product" />
            </div>
        </div>
    </div>
</div>
