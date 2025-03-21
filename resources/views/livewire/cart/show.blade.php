<x-drawer wire:model='modal' title="Carrinho de compras" class="w-1/3 p-4" right separator>
    <div class="flex flex-col space-y-8">
        @foreach ($this->products as $product)
            <div class="flex flex-row items-center w-full">
                <div class="flex flex-row items-center space-x-2 w-2/3">
                    <x-avatar :image="$product->image" class="!w-14 !rounded-lg" />
                    <p class="text-sm">{{ implode(' ', array_slice(explode(' ', $product->title), 0, 4))}}</p>  
                </div>

                <div class="flex flex-row items-end w-1/3 justify-end">
                    <p class="font-bold text-sm text-right">R$ {{ number_format($product->price / 100, 2, ',', '.') }}</p>  
                </div>
            </div>
        @endforeach

        <hr>
        <div class="flex flex-col space-y-4">
            <div class="flex flex-row items-center w-full">
                <div class="flex flex-row items-center space-x-2 w-2/3 font-bold">
                    <p>Valor Total:</p>  
                </div>
    
                <div class="flex flex-row w-1/3 justify-end">
                    <p class="font-bold text-sm">R$ {{ number_format($this->totalPrice / 100, 2, ',', '.') }}</p>  
                </div>
            </div>
    
            <x-button class="btn btn-info w-full text-lg" link="{{ route('order.index', base64_encode($orderId)) }}">Finalizar Compra</x-button>
        </div>
    </div>
</x-drawer>