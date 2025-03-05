<?php

use App\Enum\Status;
use App\Livewire\Cart\Show;
use App\Models\{Order, User};
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

// quando clicar no botão, abrir um drawer com os produtos do carrinho
it('should open a drawer to show the products', function () {
    $order = Order::factory()->create(
        [
            'user_id' => $this->user->id,
            'status'  => Status::OPEN,
        ]
    );

    Livewire::test(Show::class)
        ->call('load', $order->id)
        ->assertSet('modal', true);
});

// mostrar alguns dados do produto : imagem, nome, preço, quantidade
// mostrar o total do carrinho
// mostrar um botão para finalizar a compra, que redireciona para a página de checkout
