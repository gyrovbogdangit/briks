@php $sliderKey = $key @endphp
<div class="container position-relative">
    <h2 class="section-title mb-4 mb-md-1">{{ $title }}</h2>
    @if ($products->count())
        <div
            class="d-flex align-items-center position-relative carousel-products-row flex-column flex-lg-row w-100">
            @if ($products->count() > 5)
                <button
                    type="button"
                    class="products-swiper-prev swiper-button-prev me-2 flex-shrink-0 d-none d-lg-flex btn btn-light rounded-circle shadow-sm border-0 p-0"
                    aria-label="Предыдущие товары"
                    style="z-index:2; min-width:44px; min-height:44px; width:44px; height:44px;">
                    <i class="fa-solid fa-chevron-left fs-5 text-secondary"></i>
                </button>
            @endif
            <div class="swiper products-swiper flex-grow-1 w-100 min-w-0" data-products-slider>
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <div class="swiper-slide h-auto">
                            <livewire:product-item :product="$product" :wire:key="'{$key}-'.$product->id" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination products-swiper-pagination d-lg-none"></div>
            </div>
            @if ($products->count() > 5)
                <button
                    type="button"
                    class="products-swiper-next swiper-button-next ms-2 flex-shrink-0 d-none d-lg-flex btn btn-light rounded-circle shadow-sm border-0 p-0"
                    aria-label="Следующие товары"
                    style="z-index:2; min-width:44px; min-height:44px; width:44px; height:44px;">
                    <i class="fa-solid fa-chevron-right fs-5 text-secondary"></i>
                </button>
            @endif
        </div>
    @else
        <div class="text-muted">Нет товаров в категории</div>
    @endif
</div>
