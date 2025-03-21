<div class="flex flex-col">
    <x-toast/>

    <div class="mb-4 p-8 bg-base-100 rounded-md flex items-center">
        <!-- Área de pesquisa -->
        <div class="w-4/5 flex space-x-4 items-center">
            <div class="w-2/5">
                <x-input label="Buscar por nome" placeholder="Digite o que você procura..." icon-right="o-magnifying-glass" wire:model.live='search'/>
            </div>

            <div class="w-1/5 flex items-center space-x-4">
                <x-select label="Buscar por categoria" placeholder="Todas" :options="$this->categories" wire:model.live="searchByCategory" />
            </div>
        </div>

        <livewire:cart.button/>
    </div>

    <div class="bg-base-100 flex justify-around rounded-md">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-20 item-center mx-4 my-8">
            @foreach ($this->products as $product)
                <a href="{{ route('product.index', base64_encode($product->id)) }}">
                    <div class="card card-compact bg-base-200 border-2 border-base-200 w-full max-w-xs xl:max-w-sm 
                        shadow-xl hover:cursor-pointer hover:scale-105 transition-transform duration-300"
                    >
                        <figure>
                            <img src="{{ $product->image }}" alt="{{ $product->title }}"/>
                        </figure>

                        <div class="card-body">
                            <h2 class="text-sm xl:text-lg card-title hover:underline">{{ implode(' ', array_slice(explode(' ', $product->title), 0, 4)) }}</h2>
                        </div>

                        <div class="card-footer mx-4 mb-8 space-y-4">
                            <div class="justify-start">
                                <span class="font-bold">R$ {{ number_format($product->price / 100, 2, ',', '.') }}</span>
                            </div>
                            
                            <x-button class="btn btn-warning w-full text-lg">Ver Mais</x-button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    
    <div class="mt-4 flex justify-center">
        {{ $this->products->links() }}
    </div>

    <livewire:cart.show/>
</div>