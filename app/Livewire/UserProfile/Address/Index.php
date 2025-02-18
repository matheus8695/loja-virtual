<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    #[On('address::reload')]
    public function render(): View
    {
        return view('livewire.user-profile.address.index');
    }

    #[Computed]
    public function address(): ?Address
    {
        return Address::query()->where('user_id', Auth::user()->id)->first();
    }
}
