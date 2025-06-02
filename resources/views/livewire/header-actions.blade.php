 <div class="d-flex align-items-center justify-content-between gap-3 order-4">
     <div class="icon-item text-center">
         <a href="{{ route('favorites') }}" class="d-block me-0 text-secondary text-decoration-none position-relative">
             <i class="fas fa-bookmark fs-6"></i>
             @if (isset($favoritesQuantity) && $favoritesQuantity > 0)
                 <span
                     class="badge-counter position-absolute translate-middle badge rounded-pill bg-danger">{{ $favoritesQuantity }}</span>
             @endif
             <div class="icon-label mt-0 text-light-emphasis fw-semibold">Избранное</div>
         </a>
     </div>
     <div class="icon-item text-center border-white">
         <a href="{{ route('comparison') }}" class="d-block me-0 text-secondary text-decoration-none position-relative">
             <i class="fas fa-chart-simple fs-6"></i>
             @if (isset($comparisonQuantity) && $comparisonQuantity > 0)
                 <span
                     class="badge-counter position-absolute translate-middle badge rounded-pill bg-danger">{{ $comparisonQuantity }}</span>
             @endif
             <div class="icon-label mt-0 text-light-emphasis fw-semibold">Сравнение</div>
         </a>
     </div>
     <div class="icon-item text-center border-white">
         <a href="{{ route('cart') }}" class="d-block me-0 text-secondary text-decoration-none position-relative">
             <i class="fas fa-shopping-cart fs-6"></i>
             @if (isset($cartQuantity) && $cartQuantity > 0)
                 <span
                     class="badge-counter position-absolute translate-middle badge rounded-pill bg-danger">{{ $cartQuantity }}</span>
             @endif
             <div class="icon-label mt-0 text-light-emphasis fw-semibold">Корзина</div>
         </a>
     </div>
 </div>
