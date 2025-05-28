<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ComparisonService;

class ComparisonComponent extends Component
{
    public $categories;

    public function render()
    {
        return view('livewire.comparison-component');
    }

    public function mount()
    {
        $this->categories = ComparisonService::getCategories();
        $this->dispatch('comparisonUpdated');
    }

    public function delete($productId)
    {
        ComparisonService::delete($productId);
        $this->mount();
    }
}
