@if ($recentlyViewedProducts)
    @include('components.products-slider', [
        'title' => 'Недавно просмотренные товары',
        'products' => $recentlyViewedProducts,
        'key' => 'recentlyWatched',
    ])
@endif
