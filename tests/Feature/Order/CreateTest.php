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

    Livewire::test(Order\Create::class)
        ->call('handleProductOrder', $product);

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

    Livewire::test(Order\Create::class)
        ->call('handleProductOrder', $product2);

    assertDatabaseHas('product_orders', [
        'product_id' => $product2->id,
        'order_id'   => $order->id,
        'quantity'   => 1,
        'price'      => $product2->price,
    ]);

    assertDatabaseCount('product_orders', 2);
});
