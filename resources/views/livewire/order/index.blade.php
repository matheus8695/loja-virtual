<div>
    <x-card title="Dados do Pedido" class="h-screen" separator>
        @if ($this->products->isNotEmpty())
            @foreach ($this->products as $product)
                <div class="flex flex-col space-y-10">
                    <div class="flex flex-row items-center w-full">
                        <div class="flex flex-row items-center space-x-2 w-2/3">
                            <x-avatar :image="$product->image" class="!w-20 !rounded-lg" />
                            
                            <div class="flex flex-col">
                                <p class="text-md font-bold">{{ implode(' ', array_slice(explode(' ', $product->title), 0, 4))}}</p>  

                                <div class="flex flex-row items-center space-x-4">
                                    <livewire:order.product-quantity :id="$product->product_order_id" wire:key='quantity-{{ $product->product_order_id }}'/>
                                    <x-button 
                                        icon="o-trash" 
                                        class="btn-shadow btn-sm mt-2" 
                                        wire:key='delete-{{ $product->product_order_id }}' 
                                        wire:click='delete({{ $product->product_order_id }})'
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row items-end w-1/3 justify-end">
                            <p class="font-bold text-sm text-right">R$ {{ number_format($product->price / 100, 2, ',', '.') }}</p>  
                        </div>
                    </div>
                @endforeach

                <div class="flex flex-col">
                    <div class="flex flex-row items-center w-full">
                        <div class="flex flex-row items-center space-x-2 w-2/3 font-bold">
                            <p>Valor Total:</p>  
                        </div>
            
                        <div class="flex flex-row w-1/3 justify-end">
                            <p class="font-bold text-sm">R$ {{ number_format($this->totalPrice / 100, 2, ',', '.') }}</p>  
                        </div>
                    </div>
                </div>
            </div>

            <x-slot:actions>
                <x-button 
                    label="Finalizar Compra" 
                    class="btn-primary" 
                    wire:key='purchase-{{ $order->id }}' 
                    wire:click='purchase({{ $order->id }})'
                />
            </x-slot:actions>
        @else
            <div class="flex flex-col space-y-10">
                <p>Não há produtos para este pedido</p>
            </div>

            <x-slot:actions>
                <x-button 
                    label="Finalizar Compra" 
                    class="btn-primary btn-disabled" 
                    wire:key='purchase-{{ $order->id }}' 
                    wire:click='purchase({{ $order->id }})'
                />

                <x-button label="Voltar" class="btn-info" link="{{ route('dashboard') }}" />
            </x-slot:actions>
        @endif
    </x-card>

    <livewire:order.delete/>
    <livewire:order.purchase>
</div>
