<div>
    <div class="modal-content p-3">
        @if ($emailSended)
            <div class="alert alert-success d-flex align-items-center gap-3 mb-3" role="alert">
                <i class="fa-solid fa-circle-check fs-2 text-success"></i>
                <div>
                    <div class="fw-bold">Заявка отправлена</div>
                    <div class="small">Вам перезвонят в рабочее время <br>(Вт с 09:00).</div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
            </div>
        @else
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="flex-shrink-0">
                    <img src="{{ asset(isset($product->images[0]) ? "storage/{$product->images[0]}" : 'img/content/product-1.jpg') }}"
                        alt="{{ $product->name }}" class="rounded-3" style="width:80px;height:80px;object-fit:contain;">
                </div>
                <div class="flex-grow-1">
                    @include('components.order-product-data')
                </div>
            </div>
            <form wire:submit="sendEmail" class="needs-validation" novalidate>
                <input type="hidden" name="order" value="{{ $this->getOrderData() }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Ваше имя" wire:model="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="Ваш телефон" wire:model="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="2"
                        placeholder="Комментарий" wire:model="comment"></textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
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
                    <input class="form-check-input @error('privacy') is-invalid @enderror" type="checkbox"
                        id="privacy" wire:model="privacy">
                    <label class="form-check-label" for="privacy">
                        Даю согласие на <a href="{{ route('privacy') }}" target="_blank">обработку персональных
                            данных</a>.
                    </label>
                    @error('privacy')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Запросить стоимость</button>
                </div>
            </form>
        @endif
    </div>
</div>
