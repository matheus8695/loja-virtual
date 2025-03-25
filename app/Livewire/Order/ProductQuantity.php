<?php

namespace App\Livewire\Order;

use App\Models\ProductOrder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductQuantity extends Component
{
    public ProductOrder $productOrder;

    public ?int $quantity = null;

    public function render(): View
    {
        return view('livewire.order.product-quantity');
    }

    public function mount(int $id): void
    {
        $this->productOrder = ProductOrder::with('product')->findOrFail($id);
        $this->quantity     = $this->productOrder->quantity;
    }

    public function updatedQuantity(int $value): void
    {
        $this->productOrder->quantity = $value;
        $this->productOrder->price    = $this->productOrder->product->price * $value;

        $this->productOrder->save();

        $this->dispatch('order::refresh')->to('order.index');
    }
}
