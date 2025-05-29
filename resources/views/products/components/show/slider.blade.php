<div class="bg-white rounded-3 shadow-sm p-3 h-100">
    <div class="fancybox-gallery-main mb-3">
        @if (isset($product->images) && count($product->images))
            @foreach ($product->images as $i => $image)
                <a href="{{ asset('storage/' . $image) }}" data-fancybox="gallery" data-caption="{{ $product->name }}"
                    @if ($i > 0) style="display:none;" @endif>
                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded" alt="">
                </a>
            @endforeach
        @else
            <a href="{{ asset('img/content/product-1.jpg') }}" data-fancybox="gallery"
                data-caption="{{ $product->name }}">
                <img src="{{ asset('img/content/product-1.jpg') }}" class="d-block w-100 rounded" alt="">
            </a>
        @endif
    </div>
    @if (isset($product->images) && count($product->images) > 1)
        <div class="d-flex gap-2 mt-2 flex-nowrap overflow-auto pb-2 fancy-thumb-scroll w-100"
            style="scroll-snap-type: x mandatory; max-width: 100%;">
            @foreach ($product->images as $i => $image)
                <a href="{{ asset('storage/' . $image) }}" data-fancybox="gallery" data-caption="{{ $product->name }}"
                    style="scroll-snap-align: start; min-width: 60px; max-width: 60px;">
                    <img src="{{ asset('storage/' . $image) }}" class="rounded border"
                        style="width: 60px; height: 60px; object-fit: cover; cursor:pointer;" alt="">
                </a>
            @endforeach
        </div>
    @endif
</div>
