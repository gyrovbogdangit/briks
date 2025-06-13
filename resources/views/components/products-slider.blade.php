<div class="container position-relative">
    <h2 class="section-title mb-4 text-primary">{{ $title }}</h2>
    @if ($products->count())
        <div class="d-flex align-items-center position-relative carousel-products-row flex-column flex-sm-row"
            style="min-height: 420px;">
            @if ($products->count() > 5)
                <button
                    class="carousel-control-prev position-relative me-2 text-bg-secondary rounded-3 p-1 flex-shrink-0 d-none d-lg-flex"
                    type="button" data-bs-target="#{{ $key }}Carousel" data-bs-slide="prev"
                    style="z-index:2; min-width:44px; min-height:44px; height:44px;">
                    <i class="fa-solid fa-arrow-left fs-4"></i>
                </button>
            @endif
            <div id="{{ $key }}Carousel" class="carousel slide flex-grow-1 d-none d-lg-block">
                <div class="carousel-inner w-100">
                    @foreach ($products->chunk(5) as $chunkIndex => $chunk)
                        <div class="carousel-item @if ($chunkIndex === 0) active @endif">
                            <div
                                class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center align-items-stretch h-100 m-0 py-1">
                                @foreach ($chunk as $product)
                                    <div class="col d-flex align-items-stretch">
                                        <livewire:product-item :product="$product" :wire:key="'{$key}-'.$product->id" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-lg-none w-100">
                <div class="d-flex flex-nowrap gap-3 overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
                    @foreach ($products as $product)
                        <div style="min-width: 85vw; max-width: 90vw; scroll-snap-align: start;" class="flex-shrink-0">
                            <livewire:product-item :product="$product" :wire:key="'{$key}-mob-'.$product->id" />
                        </div>
                    @endforeach
                </div>
                <div class="text-center text-muted small mt-1">Свайпните влево/вправо для просмотра</div>
            </div>
            @if ($products->count() > 5)
                <button
                    class="carousel-control-next position-relative ms-2 text-bg-secondary rounded-3 p-1 flex-shrink-0 d-none d-lg-flex"
                    type="button" data-bs-target="#{{ $key }}Carousel" data-bs-slide="next"
                    style="z-index:2; min-width:44px; min-height:44px; height:44px;">
                    <i class="fa-solid fa-arrow-right fs-4"></i>
                </button>
            @endif
        </div>
    @else
        <div class="text-muted">Нет товаров в категории</div>
    @endif
</div>
