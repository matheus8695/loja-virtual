<div class="flex items-center justify-center">
    <x-card title="Cadastrar" shadow class="mx-auto w-[500px]">
        <x-form wire:submit="submit">
            <x-input label="Nome Completo" icon="o-user" wire:model="name" />
            <x-input label="Email" icon="o-envelope" wire:model="email" />
            <x-input label="Confirmar Email" icon="o-envelope" wire:model="email_confirmation" />
            <x-password label="Senha" clearable wire:model="password" />
            <x-input 
                label="CPF" 
                icon="o-document" 
                wire:model="document_id" 
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                maxlength="11"
            />
            <x-input 
                label="Telefone" 
                icon="o-phone" 
                wire:model="phone_number" 
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                maxlength="11"
            />
            <x-radio 
                label="Gênero" 
                :options="[['id' => 'male', 'name' => 'Masculino'], ['id' => 'female', 'name' => 'Feminino'], ['id' => 'other', 'name' => 'Outro']]" 
                wire:model="gender" 
            />
        
            <x-slot:actions>
                <x-button label="Cancelar" type="reset" />
                <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="submit" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
