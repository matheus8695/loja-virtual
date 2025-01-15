<div class="w-1/2">
    <x-card title="Endereço" class="h-screen" separator>
        <x-slot:menu>
            <x-button 
                label="Cadastrar" 
                class="btn btn-outline btn-primary"
                wire:key="btn-update-{{ $this->address->id }}"
                wire:click="update('{{ $this->address->id  }}')"
                disabled="disabled"
            />
        </x-slot:menu>
    </x-card>
</div>