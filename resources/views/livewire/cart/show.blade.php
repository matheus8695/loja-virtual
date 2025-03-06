<x-drawer wire:model='modal' title="Alterar Dados" class="w-1/3 p-4" right>
    <p>teste</p>
    @foreach ($this->products as $product)
        <p>{{ $product->image }}</p>  
        <p>{{ $product->title }}</p>  
        <p>{{ $product->price }}</p>  
    @endforeach
</x-drawer>