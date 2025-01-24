<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Livewire\Component;

class Update extends Component
{
    public Form $form;

    public function render()
    {
        return view('livewire.user-profile.address.update');
    }

    public function load(int $id)
    {
        $address = Address::query()->findOrFail($id);
        $this->form->setAddress($address);
    }

    public function update()
    {
        $this->form->update();
    }
}
