<?php

use App\Enum\Status;
use App\Livewire\Order\Delete;
use App\Models\{Order, Product, ProductOrder, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should render the component', function () {
    Livewire::test(Delete::class)->assertOk();
});

// remover o produto do pedido
it('should remove the product from product_orders', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    $order->products()->attach($product->id, [
        'quantity' => 1,
        'price'    => $product->price,
    ]);

    $productOrder = ProductOrder::query()
        ->where('order_id', '=', $order->id)
        ->first();

    Livewire::test(Delete::class)
        ->set('productOrder', $productOrder)
        ->call('destroy', $productOrder->id)
        ->assertHasNoErrors();

    assertDatabaseMissing('product_orders', [
        'id' => $productOrder->id,
    ]);
});
