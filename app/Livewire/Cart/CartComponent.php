<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Services\CartService;

class CartComponent extends Component
{
    public $products;
    public $totalSum;
    public $totalQuantity;

    public function mount()
    {
        $this->products = CartService::get();
        $this->totalSum = CartService::getTotalSum();
        $this->totalQuantity = $this->products->sum('quantity');
        $this->dispatch('cartUpdated');
    }

    public function increment($productId, $unit = 'piece')
    {
        $quantity = CartService::getQuantity($productId, $unit);
        if ($quantity >= 10000) {
            return;
        }
        CartService::update($productId, $quantity + 1, $unit);
        $this->mount();
    }

    public function decrement($productId, $unit = 'piece')
    {
        $product = $this->products->first(function ($p) use ($productId, $unit) {
            return $p->id == $productId;
        });

        if (!$product) {
            return;
        }

        $quantity = CartService::getQuantity($productId, $unit);
        if ($quantity <= 1) {
            CartService::delete($productId, $unit);
        } else {
            CartService::update($productId, $quantity - 1, $unit);
        }
        $this->mount();
    }

    public function delete($productId, $unit = 'piece')
    {
        CartService::delete($productId, $unit);
        $this->mount();
    }

    public function changeUnit($productId, $newUnit)
    {
        $quantity = CartService::getQuantity($productId);
        if ($quantity < 1) $quantity = 1;
        CartService::changeUnit($productId, $newUnit, $quantity);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.cart.cart-component');
    }
}
