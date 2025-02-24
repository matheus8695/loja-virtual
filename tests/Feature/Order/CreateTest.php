<?php

use App\Enum\Status;
use App\Livewire\Order;
use App\Models\{Product, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

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

/**
 * quando o usuário já tiver um pedido com status OPEN o sistema deve adicionar o produto na tabela productOrder
*/
