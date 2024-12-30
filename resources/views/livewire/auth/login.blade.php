<div>
    <x-card title="Entrar" shadow class="mx-auto w-[500px]">
        @if ($errors->hasAny(['invalidCredentials', 'rateLimiter']))
            <x-alert icon="o-exclamation-triangle" class="alert-warning my-2">
                @error('invalidCredentials')
                    <span>{{ $message }}</span>
                @enderror

                @error('rateLimiter')
                    <span>{{ $message }}</span>
                @enderror
            </x-alert>
        @endif

        <x-form wire:submit="login">
            <x-input label="Email" icon="o-envelope" wire:model="email" />
            <x-password label="Senha" clearable wire:model="password" />
        
            <x-slot:actions>
                <div class="w-full flex items-center justify-between">
                    <a wire.navigate href="{{ route('register') }}" class="link link-primary">Crie sua conta!</a>

                    <div>
                        <x-button label="Entrar" class="btn-primary" type="submit" spinner="submit" />
                    </div>
                </div>

            </x-slot:actions>
        </x-form>
    </x-card>
</div>
