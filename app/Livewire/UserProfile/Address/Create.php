<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\{Address, State};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, On, Rule};
use Livewire\Component;

class Create extends Component
{
    public bool $modal = false;

    #[Rule(['required', 'max:8'])]
    public string $zip_code;

    #[Rule(['required', 'exists:states,id'])]
    public ?int $state_id = null;

    #[Rule(['required', 'max:255'])]
    public string $city;

    #[Rule(['required', 'max:255'])]
    public string $district;

    #[Rule(['required', 'max:255'])]
    public string $street;

    #[Rule(['required'])]
    public int $number;

    #[Rule(['max:255'])]
    public ?string $complement = null;

    public function render(): View
    {
        return view('livewire.user-profile.address.create');
    }

    #[Computed]
    public function states()
    {
        return State::query()->orderBy('name')->get();
    }

    #[On('address::create')]
    public function load(): void
    {
        $this->modal = true;
    }

    public function create(): void
    {
        $this->validate();

        Address::query()->create([
            'user_id'    => Auth::user()->id,
            'zip_code'   => $this->zip_code,
            'state_id'   => $this->state_id,
            'district'   => $this->district,
            'city'       => $this->city,
            'street'     => $this->street,
            'number'     => $this->number,
            'complement' => $this->complement,
        ]);

        $this->modal = false;
        $this->dispatch('address::created')->to('user-profile.address.index');
    }
}
