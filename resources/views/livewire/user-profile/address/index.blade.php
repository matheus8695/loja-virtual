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

        @if ($this->address)
            <div class="bg-base-300 rounded-sm p-4">
                <div class="space-y-1 gap-4 grid grid-cols-2">
                    <x-info.data title="cep">{{ $this->address->zip_code }}</x-info.data>
                    <x-info.data title="Estado">{{ $this->address->state->name }}</x-info.data>
                    <x-info.data title="Cidade">{{ $this->address->city }}</x-info.data>
                    <x-info.data title="Bairro">{{ $this->address->district }}</x-info.data>
                    <x-info.data title="Número">{{ $this->address->street }}</x-info.data>
                    <x-info.data title="Número">{{ $this->address->number }}</x-info.data>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <x-button 
                        label="Editar" 
                        class="btn btn-shadow"
                        icon="o-pencil-square"
                        wire:key="btn-update"
                        @click="$dispatch('address::update', { id: {{ $this->address->id }} })"
                    />

                    <x-button 
                        label="Excluir" 
                        class="btn btn-shadow"
                        icon="o-trash"
                        wire:key="btn-delete"
                        @click="$dispatch('address::confirm', { id: {{ $this->address->id }} })"
                    />
                </div>
            </div>
            @else
                <div class="bg-base-300 rounded-sm p-4">
                    <h1 class="text-lg">Nenhum endereço cadastrado</h1>
                </div>
            @endif
    </x-card>

    <livewire:user-profile.address.create/>
    <livewire:user-profile.address.delete/>
    <livewire:user-profile.address.update/>
</div>