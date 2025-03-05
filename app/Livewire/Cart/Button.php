<?php

namespace App\Livewire\Cart;

use App\Models\{Order, ProductOrder};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Button extends Component
{
    public ?Order $order = null;

    public function render(): View
    {
        return view('livewire.cart.button');
    }

    #[Computed]
    public function cartCount(): int
    {
        $this->getOrderId();

        $count = $this->order ? ProductOrder::query()
            ->where('order_id', $this->order->id)
            ->count()
            : 0;

        return $count;
    }

    public function showCart(): void
    {
        $this->dispatch('cart::show', orderId: $this->order->id)->to('cart.show');
    }

    public function getOrderId(): void
    {
        $this->order = Order::query()->where('user_id', auth()->user()->id)
            ->where('status', 'open')
            ->first();
    }
}
