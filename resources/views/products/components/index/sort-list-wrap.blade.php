<div class="d-flex justify-content-between align-items-center flex-wrap p-3 rounded-3 shadow-sm bg-body">
    @php
        $originalQuery = $filter->getQuery();
    @endphp
    {{--
    @include('products.components.index.sort-list', [
        'sortTitle' => 'Показывать',
        'sortList' => ['Все' => 'all', 'Новинки' => 'new', 'Хиты продаж' => 'hits', 'Скидки' => 'discounts'],
        'sortSlug' => 'show-products',
        'attr' => 'showProducts',
    ]) --}}

    @include('products.components.index.sort-list', [
        'sortTitle' => 'Сортировка по',
        'sortList' => ['Популярности' => 'popular', 'Цене' => 'price', 'Названию' => 'name'],
        'sortSlug' => 'sort-by',
        'attr' => 'sortBy',
    ])

    @include('products.components.index.sort-list', [
        'sortTitle' => 'Показать по',
        'sortList' => ['20' => '20', '60' => '60', '100' => '100'],
        'sortSlug' => 'page-size',
        'attr' => 'pageSize',
    ])
</div>
