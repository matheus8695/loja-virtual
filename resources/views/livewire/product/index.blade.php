<div>
    <p>{{ $product->title }}</p>
    <p>{{ $product->description }}</p>
    <p>{{ $product->image }}</p>
    <p>R$ {{ number_format($product->price / 100, 2, ',', '.') }}</p>
    <p>{{ $product->brand }}</p>
    <p>{{ $product->quantity }}</p>
</div>
