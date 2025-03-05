<?php

use App\Livewire\Cart\Button;
use App\Models\User;
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
    Livewire::test(Button::class)
        ->call('showCart')
        ->assertDispatched('cart::show');
});
