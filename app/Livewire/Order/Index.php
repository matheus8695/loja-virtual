<?php

namespace App\Livewire\Order;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.order.index');
    }
}
