<?php

namespace App\Livewire\Cart;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.cart.show');
    }

    public function load(int $orderId): void
    {
        $this->modal = true;
    }
}
