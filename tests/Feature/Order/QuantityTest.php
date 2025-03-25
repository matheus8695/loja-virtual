<?php

use App\Enum\Status;
use App\Livewire\Order\ProductQuantity;
use App\Models\{Order, Product, ProductOrder, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should access the component', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    $order->products()->attach($product->id, [
        'quantity' => 1,
        'price'    => $product->price,
    ]);

    $productOrderId = ProductOrder::query()
        ->where('order_id', '=', $order->id)
        ->value('id');

    Livewire::test(ProductQuantity::class, ['id' => $productOrderId])->assertOk();
});

it('should save in database when user change the product quantity', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    $order->products()->attach($product->id, [
        'quantity' => 1,
        'price'    => $product->price,
    ]);

    $productOrderId = ProductOrder::query()
        ->where('order_id', '=', $order->id)
        ->value('id');

    Livewire::test(ProductQuantity::class, ['id' => $productOrderId])
        ->set('quantity', 2)
        ->assertHasNoErrors();

    assertDatabaseHas('product_orders', [
        'order_id'   => $order->id,
        'product_id' => $product->id,
        'quantity'   => 2,
        'price'      => $product->price * 2,
    ]);
});
