<?php

namespace App\Livewire\UserProfile\PersonalData;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    public function render(): View
    {
        return view('livewire.user-profile.personal-data.show');
    }

    #[Computed]
    public function user(): User
    {
        return Auth::user();
    }
}
