<div class="bg-white rounded-3 shadow-sm p-3 h-100">
    <div class="fancybox-gallery-main mb-3" itemscope itemtype="https://schema.org/ImageObject">
        @if (isset($product->images) && count($product->images))
            @foreach ($product->images as $i => $image)
                <a href="{{ asset('storage/' . $image) }}" data-fancybox="gallery" data-caption="{{ $product->name }}"
                    @if ($i > 0) style="display:none;" @endif>
                    @if ($loop->first)
                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded"
                            alt="{{ $product->name }}" itemprop="url">
                    @else
                        <img src="{{ asset('storage/' . ($product->thumbs[$i] ?? $image)) }}"
                            class="d-block w-100 rounded" alt="{{ $product->name }}" itemprop="url">
                    @endif
                </a>
            @endforeach
        @else
            <a href="{{ asset('img/content/product-1.jpg') }}" data-fancybox="gallery"
                data-caption="{{ $product->name }}">
                <img src="{{ asset('img/content/product-1.jpg') }}" class="d-block w-100 rounded"
                    alt="{{ $product->name }}" itemprop="url">
            </a>
        @endif
    </div>
    @if (isset($product->images) && count($product->images) > 1)
        <div class="d-flex gap-2 mt-2 flex-nowrap overflow-auto pb-2 fancy-thumb-scroll w-100"
            style="scroll-snap-type: x mandatory; max-width: 100%;">
            @foreach ($product->images as $i => $image)
                <a href="{{ asset('storage/' . $image) }}" data-fancybox="gallery" data-caption="{{ $product->name }}"
                    style="scroll-snap-align: start; min-width: 60px; max-width: 60px;" itemprop="thumbnail">
                    <img src="{{ asset('storage/' . ($product->thumbs[$i] ?? $image)) }}" class="rounded border"
                        style="width: 60px; height: 60px; object-fit: cover; cursor:pointer;" alt="" itemprop="url">
                </a>
            @endforeach
        </div>
    @endif
</div>
