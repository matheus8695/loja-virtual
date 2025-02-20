<?php

namespace App\Livewire\Userprofile;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.user-profile.index');
    }
}
