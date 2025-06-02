<h3>Товар: <a
        href="{{ route('products.show', [
            'productType' => $product->subcategory->category->productType,
            'category' => $product->subcategory->category,
            'subcategory' => $product->subcategory,
            'product' => $product,
        ]) }}">{{ $product->name }}</a>
</h3>
