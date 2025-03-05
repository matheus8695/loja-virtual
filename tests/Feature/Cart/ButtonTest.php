<?php

use App\Livewire\Cart\Button;
use App\Models\{Order, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should render the component', function () {
    Livewire::test(Button::class)
        ->assertOk();
});

it('should dispatch cart::show event', function () {
    $order = Order::factory()->create([
        'user_id' => $this->user->id,
        'status'  => 'open',
    ]);

    Livewire::test(Button::class)
        ->call('showCart')
        ->assertDispatched('cart::show', [
            'orderId' => $order->id,
        ]);
});
