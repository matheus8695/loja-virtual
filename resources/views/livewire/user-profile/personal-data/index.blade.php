<div class="w-1/2">
    <x-card title="Dados Pessoais" class="h-screen" separator>
        <x-slot:menu>
            <x-button 
                label="Alterar Dados" 
                icon="o-pencil-square"
                class="btn btn-outline btn-primary"
                wire:key="btn-update-{{ $this->user->id }}"
                wire:click="update('{{ $this->user->id  }}')"
            />
        </x-slot:menu>

        <div class="flex flex-col space-y-4 w-2/3">
            <x-input label="Email" icon="o-user" value="{{ $this->user->name }}" readonly/>
            <x-input label="Email" icon="o-envelope" value="{{ $this->user->email }}" readonly/>
            <x-input label="CPF" icon="o-document" value="{{ $this->user->document_id }}" readonly/>
            <x-input label="Gênero" icon="o-user" value="{{ $this->user->gender }}" readonly/>
            <x-input label="Telefone" icon="o-phone" value="{{ $this->user->phone_number }}" readonly/>
        </div>
    </x-card>

    <livewire:user-profile.personal-data.update/>
</div>
