<?php

namespace App\Livewire\Order;

use App\Actions\{CreateOrder, CreateProductOrder};
use App\Models\{User};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public function render(): View
    {
        return view('livewire.order.create');
    }

    public function handleProductOrder(int $productId): void
    {
        /** @var User $user */
        $user = Auth::user();

        $orderId = $user->getOpenOrderId() ?? CreateOrder::execute();
        CreateProductOrder::execute($productId, $orderId);

        $this->redirect(route('order.index', ['orderId' => $orderId]));
    }
}
