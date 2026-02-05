<div>
    @if ($emailSended)
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <div>
                <b>Заявка отправлена</b><br>
                Вам перезвонят в рабочее время <br>(Вт с 09:00).
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>
    @else
        <div class="mb-3 text-center">
            <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
                alt="{{ $product->name }}" class="img-fluid rounded mb-3" style="max-height:120px;">
            <div class="mb-2">
                @include('components.order-product-data')
            </div>
        </div>
        <form wire:submit="sendEmail" class="needs-validation" novalidate>
            <input type="hidden" name="order" value="{{ $this->getOrderData() }}">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Ваше имя" wire:model="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" placeholder="Ваш телефон" wire:model="phone" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"
                    placeholder="Комментарий" wire:model="comment" rows="3"></textarea>
                @error('comment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('quantity')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="quantity" class="form-label">Количество</label>
                <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                    name="quantity" placeholder="1 шт." wire:model="quantity">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="form-check mb-3">
                <input class="form-check-input @error('privacy') is-invalid @enderror" type="checkbox" id="privacy"
                    wire:model="privacy" required>
                <label class="form-check-label" for="privacy">
                    Даю согласие на <a href="{{ route('privacy') }}" target="_blank">обработку персональных данных</a>.
                </label>
                @error('privacy')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Запросить стоимость</button>
            </div>
        </form>
    @endif
</div>
