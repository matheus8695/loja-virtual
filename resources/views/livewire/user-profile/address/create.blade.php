<x-drawer wire:model='modal' title="Cadastrar Endereço" class="w-1/3 p-4" right>
    <x-form wire:submit='create' id="create-address-form">
        <hr class="my-5">

        <div class="space-y-2">
            <x-input label="CEP" wire:model="zip_code" inline
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="8"
            />
            <x-select label="Estado" :options="$this->states"  placeholder="Selecione um estado" wire:model="state_id" inline/>
            <x-input label="Cidade" wire:model="city" inline/>
            <x-input label="Bairro" wire:model="district" inline/>
            <x-input label="Rua" wire:model="street" inline/>
            <x-input label="Número" type='number' wire:model="number" inline/>
            <x-textarea
                label="Complemento"
                wire:model="complement"
                hint="Max 255 chars"
                rows="5"
                inline />
        </div>

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modal = false"/>
            <x-button label="Cadastrar" type="submit" form="create-address-form"/>
        </x-slot:actions>
    </x-form>
</x-drawer>