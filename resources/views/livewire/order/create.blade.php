<div>
    <x-button 
        wire:key="order-{{ $product->id }}"
        wire:click="handleProductOrder"
        class="btn btn-warning w-full text-lg" 
        icon="o-currency-dollar"
    >
        Finalizar Comprar
    </x-button>
</div>
