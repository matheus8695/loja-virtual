<?php

namespace App\Livewire\Order;

use App\Enum\Status;
use App\Models\{Order, Product, ProductOrder};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Purchase extends Component
{
    public Order $order;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.order.purchase');
    }

    #[On('order::purchase')]
    public function load(int $id): void
    {
        $this->order = Order::findOrFail($id);
        $this->modal = true;
    }

    public function finishPurchase(): void
    {
        $this->updateOrder();
        $this->updateProduct();

        $this->modal = false;
        $this->redirect(route('dashboard'));
    }

    private function updateOrder(): void
    {
        $this->order->status = Status::FINISHED;
        $this->order->save();
    }

    private function updateProduct(): void
    {
        $productOrders = ProductOrder::query()
            ->where('order_id', $this->order->id)
            ->get();

        foreach ($productOrders as $productOrder) {
            $product = Product::find($this->order->id);

            if ($product) {
                $product->quantity -= $productOrder->quantity;
                $product->save();
            }
        }
    }

}
