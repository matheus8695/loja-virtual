<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Register extends Component
{
    public ?string $name;

    public ?string $email;

    public ?string $email_confirmation;

    public ?string $password;

    public ?string $document_id;

    public ?string $phone_number;
    
    public ?string $gender;

    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        User::query()->create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "document_id" => $this->document_id,
            "phone_number" => $this->phone_number,
            "gender" => $this->gender
        ]);
    }
}
