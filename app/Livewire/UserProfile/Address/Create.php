<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required', 'max:8'])]
    public string $zip_code;

    #[Rule(['required', 'exists:states,id'])]
    public int $state_id;

    #[Rule(['required', 'max:255'])]
    public string $city;

    #[Rule(['required', 'max:255'])]
    public string $district;

    #[Rule(['required', 'max:255'])]
    public string $street;

    #[Rule(['required', 'numeric'])]
    public int $number;

    #[Rule(['max:255'])]
    public ?string $complement = null;

    public function render()
    {
        return view('livewire.user-profile.address.create');
    }

    public function save(): void
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
    }
}
