@if ($heroSliders->isNotEmpty())
    <section class="hero-swiper-section container mt-3" aria-label="Промо-слайдер">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @foreach ($heroSliders as $slide)
                    <div class="swiper-slide">
                        <a href="{{ $slide->url }}" class="hero-swiper-link d-block" aria-label="Перейти в каталог">
                            <img src="{{ asset('storage/' . $slide->image) }}" class="w-100 hero-swiper-img"
                                alt="{{ $slide->title ?? 'Слайд' }}"
                                @if ($loop->first) fetchpriority="high"
                                 @else loading="lazy" @endif
                                draggable="false">
                        </a>
                    </div>
                @endforeach
            </div>
            @if ($heroSliders->count() > 1)
                <div class="swiper-pagination hero-swiper-pagination"></div>
                <button type="button" class="swiper-button-prev hero-swiper-nav"
                    aria-label="Предыдущий слайд"></button>
                <button type="button" class="swiper-button-next hero-swiper-nav" aria-label="Следующий слайд"></button>
            @endif
        </div>
    </section>
@endif
<section class="py-lg-4 px-2 py-3">
    <div class="container position-relative">
        <div class="grid-scroll-container overflow-x-auto d-md-flex gap-md-2">
            @foreach ($types as $type)
                <a href="{{ route('product-types.show', ['productType' => $type]) }}" class="text-decoration-none">
                    <div class="card-custom bg-white p-lg-4 p-3 position-relative overflow-hidden">
                        <h3 class="small fw-bold text-dark position-absolute z-index-10">{{ $type->name }}</h3>
                        <img src="{{ asset('storage/' . $type->main_page_image) }}" alt=""
                            class="card-img-bottom-custom transition">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
