<?php

use App\Livewire\Product;
use App\Models\{Product as ModelProduct, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should be access the product route', function () {
    $product = ModelProduct::factory()->create();

    Livewire::test(Product\Index::class, ['encodedId' => base64_encode($product->id)])
        ->assertOk();
});

it('should show the product data in screen', function () {
    $product = ModelProduct::factory()->create();

    Livewire::test(Product\Index::class, ['encodedId' => base64_encode($product->id)])
        ->assertSee($product->title)
        ->assertSee($product->image)
        ->assertSee($product->description)
        ->assertSee(number_format($product->price / 100, 2, ',', '.'))
        ->assertSee($product->brand)
        ->assertSee($product->quantity);
});

it('should dispatch an event when click in purchase button', function () {
    $product = ModelProduct::factory()->create();

    Livewire::test(Product\Index::class, ['encodedId' => base64_encode($product->id)])
        ->call('handleOrder', $product->id)
        ->assertDispatched('order::handleOrder', productId: $product->id);
});
