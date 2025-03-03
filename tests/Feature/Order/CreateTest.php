<?php

use App\Enum\Status;
use App\Livewire\Order;
use App\Models\Order as ModelOrder;
use App\Models\{Product, ProductOrder, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should create an order for the logged user when click in purchasing a product and add the product in product_orders table', function () {
    $product = Product::factory()->create();

    Livewire::test(Order\Create::class, ['product' => $product])
        ->call('handleProductOrder');

    assertDatabaseHas('orders', [
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    assertDatabaseHas('product_orders', [
        'product_id' => $product->id,
        'order_id'   => $this->user->orders->first()->id,
        'quantity'   => 1,
        'price'      => $product->price,
    ]);
});

test('when a user already has an open order the system have to add the product to product_orders table', function () {
    $product1 = Product::factory()->create();
    $product2 = Product::factory()->create();

    $order = ModelOrder::factory()->create(['user_id' => $this->user->id, 'status' => Status::OPEN, ]);

    ProductOrder::factory()->create([
        'product_id' => $product1->id,
        'order_id'   => $order->id,
        'quantity'   => 1,
        'price'      => $product1->price,
    ]);

    Livewire::test(Order\Create::class, ['product' => $product2])
        ->call('handleProductOrder');

    assertDatabaseHas('product_orders', [
        'product_id' => $product2->id,
        'order_id'   => $order->id,
        'quantity'   => 1,
        'price'      => $product2->price,
    ]);

    assertDatabaseCount('product_orders', 2);
});

it('should ensure the user only has one open order at a time', function () {
    $product1 = Product::factory()->create();

    ModelOrder::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    assertDatabaseCount('orders', 1);

    Livewire::test(Order\Create::class, ['product' => $product1])
        ->call('handleProductOrder', );

    assertDatabaseCount('orders', 1);

    $product2 = Product::factory()->create();
    Livewire::test(Order\Create::class, ['product' => $product2])
        ->call('handleProductOrder', );

    assertDatabaseCount('orders', 1);

    assertDatabaseHas('orders', [
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);
});

test('When the user tries to buy a product that is already in the order the system should just redirect to the order.index route', function () {
    $product = Product::factory()->create();
    $order   = ModelOrder::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    ProductOrder::factory()->create([
        'product_id' => $product->id,
        'order_id'   => $order->id,
        'quantity'   => 1,
        'price'      => $product->price,
    ]);

    Livewire::test(Order\Create::class, ['product' => $product])
        ->call('handleProductOrder')
        ->assertHasNoErrors()
        ->assertRedirect(route('order.index', ['orderId' => base64_encode((string)$order->id)]));

    assertDatabaseCount('product_orders', 1);

    assertDatabaseHas('product_orders', [
        'order_id'   => $order->id,
        'product_id' => $product->id,
    ]);
});
