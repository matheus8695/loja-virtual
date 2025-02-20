<?php

namespace App\Livewire\UserProfile\PersonalData;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Update extends Component
{
    public User $user;

    public bool $modal = false;

    public function render(): view
    {
        return view('livewire.user-profile.personal-data.update');
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'user.name'         => ['required', 'max:255'],
            'user.email'        => ['required', 'max:255', 'email', 'unique:users,email,' . $this->user->id],
            'user.document_id'  => ['required', 'size:11'],
            'user.phone_number' => ['required', 'size:11'],
            'user.gender'       => ['required', 'in:male,female,other'],
        ];
    }

    #[On('user::update')]
    public function load(int $id): void
    {
        $this->user  = User::query()->find($id);
        $this->modal = true;
    }

    public function save(): void
    {
        $this->validate();
        $this->user->update();

        $this->modal = false;
        $this->dispatch('user-profile::reload')->to('user-profile.personal-data.index');
    }
}
