<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\Address;
use Livewire\Component;

class Delete extends Component
{
    public Address $address;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.user-profile.address.delete');
    }

    public function confirm(int $id)
    {
        $this->address = Address::query()->findOrFail($id);
        $this->modal   = true;
    }

    public function delete()
    {
        $this->address->delete();
        $this->modal = false;
        $this->dispatch('address::reload')->to('user-profile.address.index');
    }
}
