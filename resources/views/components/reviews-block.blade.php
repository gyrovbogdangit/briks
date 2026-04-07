@if ($reviews->isNotEmpty())
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm w-100 h-100" id="reviews-card">
            <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-4">Отзывы покупателей</h3>
                @isset($avgRating)
                    <div class="row align-items-center mb-5">
                        <div class="col-sm-4 text-center border-end border-light-subtle">
                            <div class="display-4 fw-bold">{{ number_format($avgRating, 1) }}</div>
                            <div class="text-warning mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa{{ $i <= round($avgRating) ? 's' : 'r' }} fa-star"></i>
                                @endfor
                            </div>
                            <div class="text-muted small">{{ $reviews->count() }}
                                {{ trans_choice('отзыв|отзыва|отзывов', $reviews->count()) }}</div>
                        </div>

                        <div class="col-sm-8 ps-sm-4">
                            <div class="d-flex flex-column gap-2">
                                @foreach ($starsCount as $star => $count)
                                    @php
                                        $percentage = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                                    @endphp
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="small fw-bold" style="width: 20px;">{{ $star }}</div>
                                        <i class="fas fa-star text-warning small"></i>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="small text-muted" style="width: 30px;">{{ $count }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="d-flex justify-content-end mb-3">
                    <select id="reviews-sort" class="form-select form-select-sm w-auto">
                        <option value="date_desc">Сначала новые</option>
                        <option value="date_asc">Сначала старые</option>
                        <option value="rating_desc">Высокий рейтинг</option>
                        <option value="rating_asc">Низкий рейтинг</option>
                    </select>
                </div>

                <div class="d-flex flex-column gap-4 reviews-list">
                    @foreach ($reviews as $review)
                        <div class="d-flex flex-column gap-2 review-item"
                            data-date="{{ $review->created_at->format('Y-m-d H:i:s') }}"
                            data-rating="{{ $review->rating }}" style="display: none !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary fw-bold"
                                        style="width: 40px; height: 40px; flex-shrink: 0; background-color: #f8f9fa !important;">
                                        {{ mb_strtoupper(mb_substr($review->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="fw-bold mb-0">{{ $review->name }}</p>
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

                            <p class="mb-0 mt-2 text-dark opacity-75" style="line-height: 1.6;">
                                {{ $review->body }}
                            </p>
                        </div>
                    @endforeach
                </div>

                @if ($reviews->count() > 3)
                    <div class="text-center mt-4 show-more-wrap">
                        <button class="btn btn-outline-primary btn-sm show-more-btn">
                            Показать ещё ({{ $reviews->count() - 3 }})
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
