<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;
use App\Services\ComparisonService;
use App\Services\FavoritesService;

class ProductActions extends Component
{
    public $product;
    public $quantity;
    public $unit;
    public $inComparison;
    public $inFavorites;

    public function render()
    {
        $quantity = CartService::getQuantity($this->product->id, $this->unit ?? 'piece');
        if ($quantity) {
            $this->quantity = $quantity;
        }

        $this->inComparison = ComparisonService::inComparison($this->product->id);
        $this->inFavorites = FavoritesService::inFavorites($this->product->id);

        return view('livewire.product-actions');
    }

    public function addToCart()
    {
        if (is_null($this->quantity) || !is_numeric($this->quantity) || $this->quantity < 1 || $this->quantity > 100) {
            $this->quantity = 1;
        }
        $unit = $this->unit ?? (isset($this->product->price_per_piece) ? 'piece' : 'sqm');
        CartService::add($this->product->id, $this->quantity, $unit);
        $this->dispatch('cartUpdated');
    }

    public function addToComparison()
    {
        ComparisonService::add($this->product->id);
        $this->dispatch('comparisonUpdated');
    }

    public function addToFavorites()
    {
        FavoritesService::add($this->product->id);
        $this->dispatch('favoritesUpdated');
    }
}
