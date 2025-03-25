<?php

namespace App\Livewire\Cart;

use App\Models\{Product, ProductOrder};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Show extends Component
{
    public bool $modal = false;

    public ?int $orderId = null;

    public function render(): View
    {
        return view('livewire.cart.show');
    }

    #[On('cart::show')]
    public function load(int $orderId): void
    {
        $this->orderId = $orderId;
        $this->modal   = true;
    }

    /**
     * @return Collection<int, Product>
     */
    #[Computed]
    public function products(): Collection
    {
        return $this->orderId
            ? Product::getByOrderId($this->orderId)
            : collect();
    }

    #[Computed]
    public function totalPrice(): int
    {
        return ProductOrder::where('order_id', $this->orderId)
            ->sum('price');
    }
}
