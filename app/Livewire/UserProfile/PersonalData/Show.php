<?php

namespace App\Livewire\UserProfile\PersonalData;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Show extends Component
{
    #[On('user-profile::reload')]
    public function render(): View
    {
        return view('livewire.user-profile.personal-data.show');
    }

    #[Computed]
    public function user(): User
    {
        return Auth::user();
    }

    public function update(int $id): void
    {
        $this->dispatch('user::update', id: $id)->to("user-profile.personal-data.update");
    }
}
