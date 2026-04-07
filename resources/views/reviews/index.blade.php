@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <h1 class="fw-bold mb-4">Отзывы</h1>

        @include('components.latest-reviews', ['latestReviews' => $reviews, 'showTitle' => false])

        {{ $reviews->links() }}
    </div>
@endsection
