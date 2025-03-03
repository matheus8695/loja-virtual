<div>
    <x-button 
        wire:key="order-{{ $product->id }}"
        wire:click="handleProductOrder"
        class="btn btn-warning w-full text-lg" 
        icon="o-shopping-cart"
    >
        Finalizar Comprar
    </x-button>
</div>
