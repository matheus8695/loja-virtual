<x-drawer wire:model='modal' title="Alterar Dados" class="w-1/3 p-4" right>
    <x-form wire:submit='save' id="update-user-form">
        <hr class="my-5">

        <div class="space-y-2">
            <x-input label="Nome Completo" icon="o-user" wire:model="user.name"/>

            <x-input label="Email" icon="o-envelope" wire:model="user.email" />
            
            <x-input label="CPF" icon="o-document" wire:model="user.document_id" 
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11"
            />
           
            <x-input label="Telefone" icon="o-phone" wire:model="user.phone_number" 
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11"
            />
           
            <x-radio label="Gênero" wire:model="user.gender" 
                :options="[['id' => 'male', 'name' => 'Masculino'], ['id' => 'female', 'name' => 'Feminino'], ['id' => 'other', 'name' => 'Outro']]"
            />
        </div>

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modal = false"/>
            <x-button label="Save" type="submit" form="update-user-form"/>
        </x-slot:actions>
    </x-form>
</x-drawer>