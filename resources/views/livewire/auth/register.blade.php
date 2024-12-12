<div class="flex items-center justify-center">
    <x-card title="Register" shadow class="mx-auto w-[500px]">
        <x-form wire:submit="submit">
            <x-input label="Nome Completo" wire:model="name" />
            <x-input label="Email" wire:model="email" />
            <x-input label="Confirmar Email" wire:model="email_confirmation" />
            <x-input label="Senha" wire:model="name" type="password" />
        
            <x-slot:actions>
                <x-button label="Cancelar" type="reset" />
                <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="submit" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
