<?php

namespace App\Livewire\Order;

use App\Models\{Product, User};
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Product $product;

    public function render(): View
    {
        return view('livewire.order.create');
    }

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function handleProductOrder(): void
    {
        /** @var User $user */
        $user  = Auth::user();
        $order = (new OrderService())->addProductToOrder($this->product, $user);

        $this->redirect(route('order.index', ['orderId' => $order->id]));
    }
}
