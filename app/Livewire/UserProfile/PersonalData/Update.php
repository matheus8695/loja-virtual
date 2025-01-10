<?php

namespace App\Livewire\UserProfile\PersonalData;

use App\Models\User;
use Livewire\Attributes\{On, Rule};
use Livewire\Component;

class Update extends Component
{
    public ?User $user = null;

    public bool $modal = false;

    #[Rule(['required', 'max:255'])]
    public ?string $name = null;

    #[Rule(['required', 'max:255', 'email', 'confirmed', 'unique:users,email'])]
    public ?string $email = null;

    #[Rule(['required'])]
    public ?string $email_confirmation = null;

    #[Rule(['required', 'size:11'])]
    public ?string $document_id = null;

    #[Rule(['required', 'size:11'])]
    public ?string $phone_number = null;

    #[Rule(['required', 'in:male,female,other'])]
    public ?string $gender = null;

    public function render()
    {
        return view('livewire.user-profile.personal-data.update');
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

        $this->user->name         = $this->name;
        $this->user->email        = $this->email;
        $this->user->document_id  = $this->document_id;
        $this->user->phone_number = $this->phone_number;
        $this->user->gender       = $this->gender;

        $this->user->update();
    }
}
