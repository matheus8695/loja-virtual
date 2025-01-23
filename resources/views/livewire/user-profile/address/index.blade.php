<div class="w-1/2">
    <x-card title="Endereço" class="h-screen" separator>
        @if (!$this->address)
            <x-slot:menu>
                <x-button 
                    label="Cadastrar Endereço" 
                    class="btn btn-outline btn-primary"
                    icon="o-map-pin"
                    wire:key="btn-create"
                    @click="$dispatch('address::create')"
                />
            </x-slot:menu>
        @endif

        <div class="bg-base-300 rounded-sm p-4">
            <div class="space-y-1 gap-4 grid grid-cols-2">
                @if ($this->address)
                    <x-info.data title="cep">{{ $this->address->zip_code }}</x-info.data>
                    <x-info.data title="Estado">{{ $this->address->state->name }}</x-info.data>
                    <x-info.data title="Cidade">{{ $this->address->city }}</x-info.data>
                    <x-info.data title="Bairro">{{ $this->address->district }}</x-info.data>
                    <x-info.data title="Número">{{ $this->address->street }}</x-info.data>
                    <x-info.data title="Número">{{ $this->address->number }}</x-info.data>
                @else
                    <h1 class="text-lg">Nenhum endereço cadastrado</h1>
                @endif
            </div>
        </div>
    </x-card>

    <livewire:user-profile.address.create/>
</div>