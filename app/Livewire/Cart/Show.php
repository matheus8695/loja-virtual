<?php

namespace App\Livewire\Cart;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use stdClass;

class Show extends Component
{
    public bool $modal = false;

    public ?int $OrderId = null;

    public function render(): View
    {
        return view('livewire.cart.show');
    }

    #[On('cart::show')]
    public function load(int $orderId): void
    {
        $this->OrderId = $orderId;
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
            ->where('po.order_id', 22)
            ->select('p.title', 'p.price', 'p.image')
            ->get();
    }
}
