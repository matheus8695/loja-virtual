<?php

namespace App\Livewire\Cart;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.cart.show');
    }

    #[On('cart::show')]
    public function load(int $orderId): void
    {
        $this->modal = true;
    }
}
