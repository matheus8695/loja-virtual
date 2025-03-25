<?php

namespace App\Livewire\Order;

use App\Models\ProductOrder;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public ?ProductOrder $productOrder = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.order.delete');
    }

    #[On('order::delete')]
    public function load(int $id): void
    {
        $this->productOrder = ProductOrder::query()
            ->findOrFail($id)
            ->first();

        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->productOrder->delete();

        $this->modal = false;
        $this->dispatch('order::refresh')->to('order.index');
    }
}
