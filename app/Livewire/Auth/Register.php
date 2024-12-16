<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(['required', 'max:255'])]
    public ?string $name = null;

    #[Rule(['required', 'max:255', 'email', 'confirmed', 'unique:users,email'])]
    public ?string $email = null;

    #[Rule(['required'])]
    public ?string $email_confirmation = null;

    #[Rule(['required', 'min:6'])]
    public ?string $password = null;

    #[Rule(['required', 'size:11'])]
    public ?string $document_id = null;

    #[Rule(['required', 'size:11'])]
    public ?string $phone_number = null;

    #[Rule(['required', 'in:male,female,other'])]
    public ?string $gender = null;

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        $this->validate();

        $user = User::query()->create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "document_id" => $this->document_id,
            "phone_number" => $this->phone_number,
            "gender" => $this->gender
        ]);

        Auth::login($user);

        $this->redirect(route('dashboard'));
    }
}
