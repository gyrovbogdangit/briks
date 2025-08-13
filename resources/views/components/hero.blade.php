<section id="heroCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($heroSliders as $i => $slide)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                @if ($loop->first) class="active" aria-current="true" @endif
                aria-label="Slide {{ $i + 1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach ($heroSliders as $slide)
            <div class="carousel-item @if ($loop->first) active @endif">
                <a href="{{ $slide->url }}" aria-label="Перейти в каталог">
                    <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100"
                        alt="{{ $slide->title ?? 'Слайд' }}" style="height: 500px; object-fit: cover;" loading="lazy">
                </a>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
        aria-label="carousel-prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
        aria-label="carousel-next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>
