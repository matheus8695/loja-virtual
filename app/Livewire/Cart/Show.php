<?php

namespace App\Livewire\Cart;

use App\Models\ProductOrder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use stdClass;

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
     * @return Collection<int, stdClass>
     */
    #[Computed]
    public function products(): Collection
    {
        return DB::table('products as p')
            ->join('product_orders as po', 'po.product_id', '=', 'p.id')
            ->where('po.order_id', $this->orderId)
            ->select('p.title', 'p.price', 'p.image')
            ->get();
    }

    #[Computed]
    public function totalPrice(): int
    {
        return ProductOrder::where('order_id', $this->orderId)
            ->sum('price');
    }
}
