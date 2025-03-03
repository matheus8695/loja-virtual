<div class="bg-base-100 p-6 space-y-6 rounded-md">
    <div class="flex items-stretch space-x-6 w-full">
        <!-- Image -->
        <div class="w-1/2">
            <figure>
                <img class="w-full rounded-md" src="{{ $product->image }}" alt="{{ $product->title }}"/>
            </figure>
        </div>

        <!-- Product data -->
        <div class="w-1/2 flex flex-col justify-between">
            <div>
                <x-header title="{{ $product->title }}" subtitle="Marca: {{ $product->brand }}" size="text-xl" separator />

                <div class="flex flex-col space-y-2">
                    <h2 class="text-green-400 text-2xl font-bold">R$ {{ number_format($product->price / 100, 2, ',', '.') }}</h2>
                    <h2 class="text-lg font-semibold">Em Estoque: {{ $product->quantity }}</h2> 
                </div>
            </div>
 
            <!-- Button -->
            <div class="mt-auto space-y-2">
                <livewire:cart.create :product="$product"/>
                <livewire:order.create :product="$product"/>
            </div>
        </div>
    </div>

    {{-- Product Description --}}
    <div class="w-full flex flex-col space-y-2">
        <h2 class="font-bold text-lg">Descrição:</h2>
        <p class="text-lg pl-4">{{ $product->description }}</p>
    </div>
</div>
