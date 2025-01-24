<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\{Address, State};
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Update extends Component
{
    public Form $form;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.user-profile.address.update');
    }

    #[Computed]
    public function states(): Collection
    {
        return State::query()->orderBy('name')->get();
    }

    #[On('address::update')]
    public function load(int $id): void
    {
        $address = Address::query()->findOrFail($id);
        $this->form->setAddress($address);

        $this->modal = true;
    }

    public function update(): void
    {
        $this->form->update();
        $this->modal = false;
    }
}
