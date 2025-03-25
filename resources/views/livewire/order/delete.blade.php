<x-modal wire:model="modal" title="Excluir">
    <div>Tenha certeza que deseja remover esse produto?</div>
    
    <x-slot:actions>
        <x-button label="Cancelar" @click="$wire.modal = false" />
        <x-button label="Sim, tenho certeza" class="btn-primary" wire:click='destroy'/>
    </x-slot:actions>
</x-modal>
