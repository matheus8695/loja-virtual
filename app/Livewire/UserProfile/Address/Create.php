<?php

namespace App\Livewire\UserProfile\Address;

use App\Models\{State};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.user-profile.address.create');
    }

    /**
     * @return Collection<int,State>
     */
    #[Computed]
    public function states(): Collection
    {
        return State::query()->orderBy('name')->get();
    }

    #[On('address::create')]
    public function load(): void
    {
        $this->form->resetErrorBag();
        $this->modal = true;
    }

    public function create(): void
    {
        $this->form->create();
        $this->modal = false;

        $this->dispatch('address::reload')->to('user-profile.address.index');
    }
}
