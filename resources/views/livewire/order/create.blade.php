<div>
    <x-button 
        wire:key="order-{{ $product->id }}"
        wire:click="handleProductOrder"
        class="btn btn-warning w-full text-lg" 
        icon="o-shopping-cart"
    >
        Comprar
    </x-button>
</div>
