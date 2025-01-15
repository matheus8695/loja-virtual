<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user-profile.address.index');
    }

    #[Computed]
    public function address(): ?Address
    {
        return Address::query()->find(Auth::user()->id);
    }
}
