<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Form as BaseForm;

class Form extends BaseForm
{
    public string $zip_code = '';

    public ?int $state_id = null;

    public string $city = '';

    public string $district = '';

    public string $street = '';

    public int $number;

    public ?string $complement = null;

    public function rules()
    {
        return [
            'zip_code'   => ['required', 'max:8'],
            'state_id'   => ['required', 'exists:states,id'],
            'city'       => ['required', 'max:255'],
            'district'   => ['required', 'max:255'],
            'street'     => ['required', 'max:255'],
            'number'     => ['required'],
            'complement' => ['max:255'],
        ];
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

        $this->reset();
    }
}
