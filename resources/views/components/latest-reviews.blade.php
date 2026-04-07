@if ($latestReviews->isNotEmpty())
    <div class="container">
        @if (!isset($showTitle))
            <h2 class="fw-bold mb-4 mb-4">Последние отзывы</h2>
        @endif

        <div class="d-flex flex-column gap-3">
            @foreach ($latestReviews as $review)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom border-light-subtle py-2">
                        <a href="{{ route('products.show', [
                            'productType' => $review->product->subcategory->category->productType,
                            'category' => $review->product->subcategory->category,
                            'subcategory' => $review->product->subcategory,
                            'product' => $review->product,
                        ]) }}"
                            class="d-flex align-items-center gap-3 text-decoration-none text-primary">
                            @if (!empty($review->product->images[0]))
                                <img src="{{ asset('storage/' . $review->product->images[0]) }}"
                                    alt="{{ $review->product->name }}"
                                    style="width: 40px; height: 40px; object-fit: contain; flex-shrink: 0;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                    style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="fa-solid fa-images text-muted small"></i>
                                </div>
                            @endif
                            <span class="small">{{ $review->product->name }}</span>
                        </a>
                    </div>
                    <div class="card-body py-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary fw-bold"
                                    style="width: 36px; height: 36px; flex-shrink: 0; background-color: #f8f9fa !important;">
                                    {{ mb_strtoupper(mb_substr($review->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="fw-bold mb-0 small">{{ $review->name }}</p>
                                    <p class="text-muted mb-0" style="font-size: 10px;">
                                        {{ $review->created_at->translatedFormat('j F Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-warning small d-flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="mb-0 text-dark opacity-75 small" style="line-height: 1.6;">{{ $review->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
