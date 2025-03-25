<x-modal wire:model="modal" title="Excluir">
    <div>Por favor, confirma a compra dos produtos?</div>
    
    <x-slot:actions>
        <x-button label="Cancelar" @click="$wire.modal = false" />
        <x-button label="Sim, tenho certeza" class="btn-primary" wire:click='finishPurchase'/>
    </x-slot:actions>
</x-modal>
