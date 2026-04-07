<div class="container mb-4">
    <dir class="row ps-0">
        @include('components.reviews-block')

        <div class="col-12 @if ($reviews->isNotEmpty()) col-md-6 mt-md-0 mt-4 @endif">
            <div class="card border-0 shadow-sm w-100">
                <div class="p-3">
                    <h3 class="h5 fw-semibold mb-3">Оставить отзыв</h3>
                    <p class="muted">
                        Ваши телефон и email не будут опубликованы — они нужны нам, чтобы проверить подлинность заказа.
                    </p>
                </div>

                <div class="card-body">
                    @if (session('review_sent'))
                        <div class="alert alert-success">Спасибо! Ваш отзыв отправлен на модерацию.</div>
                    @endif

                    <form method="POST" action="{{ route('reviews.store', $product) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Имя <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Телефон <span class="text-danger">*</span></label>
                                <input type="tel" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Оценка <span class="text-danger">*</span></label>
                                <div>
                                    <input type="hidden" name="rating" id="rating" value="{{ old('rating', 0) }}"
                                        required>

                                    <div id="starRating" class="text-warning d-flex" style="cursor: pointer;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">☆</span>
                                        @endfor
                                    </div>

                                    @error('rating')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                @error('rating')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Отзыв <span class="text-danger">*</span></label>
                                <textarea name="body" rows="4" class="form-control @error('body') is-invalid @enderror" required>{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </dir>
</div>
