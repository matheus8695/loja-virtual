<div>
    <x-button 
        wire:key="add-cart-{{ $product->id }}"
        wire:click="handleProductOrder"
        class="btn btn-info w-full text-lg" 
        icon="o-shopping-cart"
    >
        Adicionar ao carrinho
    </x-button>
</div>
