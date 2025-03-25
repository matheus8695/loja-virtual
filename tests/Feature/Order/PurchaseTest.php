<?php

use App\Enum\Status;
use App\Livewire\Order\Purchase;
use App\Models\{Order, Product, ProductOrder, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should render the component', function () {
    Livewire::test(Purchase::class)->assertOk();
});

// ao comprar ao finalizar uma compra a quantidade do produto deve ser atualizada
it('should update the quantity and status of products in stock', function () {
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

    Livewire::test(Purchase::class)
        ->set('order', $order)
        ->call('finishPurchase', $order->id)
        ->assertHasNoErrors();

    assertDatabaseHas('orders', [
        'id'     => $order->id,
        'status' => Status::FINISHED,
    ]);

    assertDatabaseHas('products', [
        'id'       => $product->id,
        'quantity' => ($product->quantity - $productOrder->quantity),
    ]);
});
