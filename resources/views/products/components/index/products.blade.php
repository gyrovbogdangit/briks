 <div class="container">
     <div class="products-grid" itemscope itemtype="https://schema.org/ItemList">
         @if ($products->count() > 0)
             @foreach ($products as $product)
                 <livewire:product-item :product="$product" />
             @endforeach
         @else
             <p>Нечего не найдено. Возможно вы выбрали слишком много фильтров.
                 <a
                     href="{{ route('products.index', ['productType' => $type, 'category' => $filter->category, 'subcategory' => $filter->subcategory]) }}">Очистить
                     фильтры.</a>
             </p>
         @endif
     </div>
     <div class="mt-4">
         @include('products.components.index.pagination')
     </div>
 </div>
