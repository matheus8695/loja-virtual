<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Form as BaseForm;

class Form extends BaseForm
{
    public ?Address $address = null;

    public string $zip_code = '';

    public ?int $state_id = null;

    public string $city = '';

    public string $district = '';

    public string $street = '';

    public ?int $number = null;

    public ?string $complement = null;

    public function rules(): array
    {
        return [
            'zip_code'   => ['required', 'max:8'],
            'state_id'   => ['required', 'exists:states,id'],
            'city'       => ['required', 'max:255'],
            'district'   => ['required', 'max:255'],
            'street'     => ['required', 'max:255'],
            'number'     => ['required', 'integer'],
            'complement' => ['max:255'],
        ];
    }

    public function setAddress(Address $address): void
    {
        $this->address    = $address;
        $this->zip_code   = $address->zip_code;
        $this->state_id   = $address->state_id;
        $this->city       = $address->city;
        $this->district   = $address->district;
        $this->street     = $address->street;
        $this->number     = $address->number;
        $this->complement = $address->complement;
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

    public function update(): void
    {
        $this->validate();

        $this->address->zip_code   = $this->zip_code;
        $this->address->state_id   = $this->state_id;
        $this->address->city       = $this->city;
        $this->address->district   = $this->district;
        $this->address->street     = $this->street;
        $this->address->number     = $this->number;
        $this->address->complement = $this->complement;

        $this->address->update();
    }

    public function destroy(Address $address): void
    {
        $address->delete();
    }
}
