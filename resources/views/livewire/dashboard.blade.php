<div class="flex flex-col space-y-4">
    <div class="mb-4 p-8 bg-base-100">
        <h1 class="mb-4">Filtros</h1>
        <div class="mb-4 flex space-x-4 items-center">  
            <div class="w-2/5">
                <x-input placeholder="Buscar por nome" wire:model.live='search'/>
            </div>

            <div class="w-1/5">
                <x-select placeholder="Todas" :options="$this->categories" wire:model.live="searchByCategory" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($this->products as $product)
            <div class="card card-compact bg-base-100 w-96 shadow-xl hover:cursor-pointer hover:scale-105 transition-transform duration-300">
                <figure>
                    <img src="{{ $product->image }}" alt="{{ $product->title }}"/>
                </figure>

                <div class="card-body">
                    <h2 class="card-title">{{ implode(' ', array_slice(explode(' ', $product->title), 0, 4)) }}</h2>

                    <div class="text-lg justify-start">
                        <span class="font-bold">R$ {{ number_format($product->price / 100, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-4 flex justify-center">
        {{ $this->products->links() }}
    </div>
</div>