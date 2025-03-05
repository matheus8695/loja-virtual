<div class="ml-auto"">
    <x-button
        wire:click="showCart"
        icon="o-shopping-cart" 
        class="btn-circle relative"
    >
        <x-badge value="{{ $this->cartCount }}" class="badge-error absolute -right-2 -top-2" />
    </x-button>
</div>