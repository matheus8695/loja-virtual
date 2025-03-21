<?php

use App\Livewire\Order;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /**@var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

// o componente deve estar rodando
it('should access the componente finalize', function () {
    Livewire::test(Order\Index::class)->assertOk();
});

// mostrar os dados dos produtos do pedido

// quando aletrar a quantidade de produtos , deve salvar no banco e mudar alterar o preço do pedido
