<?php

use App\Enum\Status;
use App\Livewire\Order\Index;
use App\Models\{Order, Product, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseEmpty};

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should access the componente', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    Livewire::withQueryParams(['orderId' => base64_encode($order->id)])
        ->test(Index::class)->assertOk();
});

it('should show the product data in screen', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    $order->products()->attach($product->id, [
        'quantity' => 1,
        'price'    => $product->price,
    ]);

    Livewire::withQueryParams(['orderId' => base64_encode($order->id)])
        ->test(Index::class)
        ->assertSee(implode(' ', array_slice(explode(' ', $product->title), 0, 4)))
        ->assertSee(number_format($product->price / 100, 2, ',', '.'));
});

it('should show a message when the are no products in the order', function () {
    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    assertDatabaseEmpty('product_orders');

    Livewire::withQueryParams(['orderId' => base64_encode($order->id)])
        ->test(Index::class)
        ->assertSee('Não há produtos para este pedido');
});
