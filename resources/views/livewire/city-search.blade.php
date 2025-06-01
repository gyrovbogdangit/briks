<div class="modal-body">
    <form class="mb-3">
        <div class="mb-2">
            <label for="city-search-input" class="form-label">Поиск</label>
            <input type="text" class="form-control" id="city-search-input" placeholder="Начните вводить город..."
                wire:model.live="search">
        </div>
    </form>
    <div style="max-height: 400px; overflow-y: auto;" class="fancy-thumb-scroll">
        @foreach ($groupedCities as $capitalLetter => $cities)
            <div class="mb-2">
                <div class="fw-bold text-secondary small mb-1">{{ $capitalLetter }}</div>
                <div class="list-group">
                    @foreach ($cities as $city)
                        <button type="button"
                            class="list-group-item list-group-item-action city-btn text-start py-1 px-2"
                            wire:click="chooseCity({{ $city->id }})" data-bs-dismiss="modal">
                            {{ $city->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
