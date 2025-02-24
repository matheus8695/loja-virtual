<?php

namespace App\Livewire\Order;

use App\Models\{Product};
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    protected OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function render(): View
    {
        return view('livewire.order.create');
    }

    public function handleProductOrder(Product $product): void
    {
        $this->orderService->addProductToOrder($product);
    }
}
