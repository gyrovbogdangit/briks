<section class="py-lg-5 px-2 py-3">
    <div class="container position-relative">
        <div class="grid-scroll-container overflow-x-auto d-md-flex gap-md-2">
            @foreach ($types as $type)
                <a href="{{ route('product-types.show', ['productType' => $type]) }}" class="text-decoration-none">
                    <div class="card-custom bg-white rounded-5 p-lg-4 p-3 position-relative overflow-hidden">
                        <h3 class="small fw-bold text-dark position-absolute z-index-10" style="max-width: 80%">{{ $type->name }}</h3>
                        <img src="{{ asset('storage/' . $type->image) }}" alt=""
                            class="card-img-bottom-custom transition">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
