<div class="good-info bg-white rounded shadow-sm p-4">
    <div class="table-responsive mb-3">
        <table class="table table-bordered align-middle mb-0">
            <tbody>
                @foreach ($product->attributeValues->take(5) as $attributeValue)
                    <tr>
                        <th class="bg-light">{{ $attributeValue->attribute->name }}</th>
                        <td>{{ $attributeValue->value->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
        <a class="btn btn-outline-primary" href="#chars" data-tab-index="1"><i class="icon-arrow3"></i> Все
            характеристики</a>
        @isset($product->article)
            <div class="text-muted">Артикул: <span class="fw-semibold">{{ $product->article }}</span></div>
        @endisset
    </div>
    {{-- <livewire:product-actions :product="$product" /> --}}
</div>
