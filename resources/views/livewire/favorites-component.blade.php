<div>
    @if (count($products))
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <livewire:product-item :product="$product" />
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-5 rounded-3 shadow-sm">
            <p class="mb-2 fs-4">Избранные товары отсутствуют!</p>
            <p class="mb-0">Вы можете добавить в неё новые товары из <a href="{{ route('catalog') }}"
                    class="fw-bold text-primary">каталога</a>!</p>
        </div>
    @endif
</div>
