<?php

namespace App\Livewire\Order;

use App\Models\{Order, Product, ProductOrder};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

#[On('order::refresh')]
class Index extends Component
{
    public Order $order;

    public function render(): View
    {
        return view('livewire.order.index');
    }

    public function mount(): void
    {
        $encodeId = request('orderId');

        $this->order = Order::findOrFail(base64_decode($encodeId));
    }

    /**
     * @return Collection<int, Product>
     */
    #[Computed]
    public function products(): Collection
    {
        return Product::getByOrderId($this->order->id);
    }

    #[Computed]
    public function totalPrice(): int
    {
        return ProductOrder::where('order_id', $this->order->id)
            ->sum('price');
    }

    public function delete(int $id): void
    {
        $this->dispatch('order::delete', id: $id)->to('order.delete');
    }

    public function purchase(int $id): void
    {
        $this->dispatch('order::purchase', id: $id)->to('order.purchase');
    }
}
