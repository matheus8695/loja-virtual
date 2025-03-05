<?php

use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test('cart.show')
        ->assertOk();
});

// quando clicar no botão, abrir um drawer com os produtos do carrinho
// mostrar alguns dados do produto : imagem, nome, preço, quantidade
// mostrar o total do carrinho
// mostrar um botão para finalizar a compra, que redireciona para a página de checkout
