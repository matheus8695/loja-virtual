<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public Address $address;

    public Form $form;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.user-profile.address.delete');
    }

    #[On('address::confirm')]
    public function confirm(int $id)
    {
        $this->address = Address::query()->findOrFail($id);
        $this->modal   = true;
    }

    public function delete()
    {
        $this->form->destroy($this->address);
        $this->modal = false;

        $this->dispatch('address::reload')->to('user-profile.address.index');
    }
}
