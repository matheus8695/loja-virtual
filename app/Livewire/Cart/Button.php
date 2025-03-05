<?php

namespace App\Livewire\Cart;

use App\Models\{Order, ProductOrder};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Button extends Component
{
    public function render(): View
    {
        return view('livewire.cart.button');
    }

    #[Computed]
    public function cartCount(): int
    {
        $order = Order::query()->where('user_id', auth()->user()->id)
            ->where('status', 'open')
            ->first();

        $count = $order ? ProductOrder::query()
            ->where('order_id', $order->id)
            ->count()
            : 0;

        return $count;
    }

    public function showCart(): void
    {
        $this->dispatch('cart::show')->to('cart.show');
    }
}
