<div class="order__data order-data">
    <div class="order-data__title">{{ $product->name }}</div>
    <div class="order-data__product-data product-data">
        @isset($product->article)
            <div class="product-data__item">
                <div class="product-data__title">Артикул:</div>
                <div class="product-data__content">{{ $product->article }}</div>
            </div>
        @endisset
    </div>
</div>
