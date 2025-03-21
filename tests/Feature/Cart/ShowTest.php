<?php

use App\Enum\Status;
use App\Livewire\Cart\Show;
use App\Models\{Order, Product, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should render the component', function () {
    Livewire::test('cart.show')
        ->assertOk();
});

it('should open a drawer to show the products', function () {
    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    Livewire::test(Show::class)
        ->call('load', $order->id)
        ->assertSet('modal', true);
});

it('should show the products data in the screen', function () {
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => Status::OPEN,
    ]);

    $order->products()->attach($product->id, [
        'quantity' => 1,
        'price'    => $product->price,
    ]);

    // abrir o carrinho
    Livewire::test(Show::class)
        ->call('load', $order->id)
        ->assertSee($product->image)
        ->assertSee(implode(' ', array_slice(explode(' ', $product->title), 0, 4)))
        ->assertSee(number_format($product->price / 100, 2, ',', '.'));
});
