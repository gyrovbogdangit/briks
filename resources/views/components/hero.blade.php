<section id="heroCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($heroSliders as $i => $slide)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                @if ($loop->first) class="active"
                aria-current="true" @endif
                aria-label="Slide {{ $i }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($heroSliders as $slide)
            <div class="carousel-item @if ($loop->first) active @endif">
                <a href="{{ $slide->url }}">
                    <div class="hero-banner d-flex align-items-center justify-content-center text-center"
                        style="background: url('{{ asset('storage/' . $slide->image) }}') center/cover no-repeat;
                            height: 500px;position: relative;">
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next z-3" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>
