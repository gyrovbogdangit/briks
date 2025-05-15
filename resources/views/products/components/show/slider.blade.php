<div class="goods-wrap-slider bg-white rounded shadow-sm p-3">
    <div id="productMainCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (isset($product->images) && count($product->images))
                @foreach ($product->images as $i => $image)
                    <div class="carousel-item @if ($i === 0) active @endif">
                        <div href="{{ asset('storage/' . $image) }}">
                            <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded" alt="">
                        </div>
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <a href="{{ asset('img/content/product-1.jpg') }}">
                        <img src="{{ asset('img/content/product-1.jpg') }}" class="d-block w-100 rounded"
                            alt="">
                    </a>
                </div>
            @endif
        </div>
        @if (isset($product->images) && count($product->images) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#productMainCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productMainCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        @endif
    </div>
    @if (isset($product->images) && count($product->images) > 1)
        <div class="d-flex gap-2 justify-content-center mt-2">
            @foreach ($product->images as $i => $image)
                <img src="{{ asset('storage/' . $image) }}" class="rounded border"
                    style="width: 60px; height: 60px; object-fit: cover; cursor:pointer;"
                    data-bs-target="#productMainCarousel" data-bs-slide-to="{{ $i }}"
                    @if ($i === 0) aria-current="true" @endif aria-label="Slide {{ $i + 1 }}">
            @endforeach
        </div>
    @endif
</div>
