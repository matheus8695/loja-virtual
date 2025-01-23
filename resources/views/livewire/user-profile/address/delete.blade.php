<x-modal 
    wire:model='modal' 
    title="Excluir Endereço"
    subtitle="Deseja excluir este endereço?" 
>
    <x-slot:actions>
        <x-button label="Não" @click="$wire.modal = false"/>
        <x-button label="Sim, tenho certeza" class="btn-primary" wire:click='delete'/>
    </x-slot:actions>
</x-modal>