<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public Product $product;

    public function render(): View
    {
        return view('livewire.product.index');
    }

    public function mount(string $encodedId): void
    {
        $this->product = Product::findOrFail(base64_decode($encodedId));
    }

    public function handleOrder(int $productId): void
    {
        $this->dispatch('order::handleOrder', productId: $productId)->to('order.create');
    }
}
