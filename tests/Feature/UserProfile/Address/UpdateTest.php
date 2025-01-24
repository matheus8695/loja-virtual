<?php

// Editar o endereço

use App\Livewire\UserProfile\Address\Update;
use App\Models\{Address, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be able to update a address', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);

    /** @var User $user */
    $user    = User::factory()->create();
    $address = Address::factory()->create(['user_id' => $user->id]);

    actingAs($user);

    Livewire::test(Update::class)
        ->call('load', $address->id)
        ->set('form.street', 'Rua teste')
        ->set('form.number', '123')
        ->set('form.complement', 'Casa')
        ->set('form.district', 'Bairro')
        ->set('form.city', 'Cidade')
        ->set('form.state_id', 1)
        ->set('form.zip_code', '12345678')
        ->call('update')
        ->assertHasNoErrors();

    assertDatabaseHas('addresses', [
        'id'         => $address->id,
        'street'     => 'Rua teste',
        'number'     => '123',
        'complement' => 'Casa',
        'district'   => 'Bairro',
        'city'       => 'Cidade',
        'state_id'   => 1,
        'zip_code'   => '12345678',
    ]);
});

// validações de campos obrigatórios

// abrir um drawer para editar o endereço

// fechar o drawer depois de editar

// enviar um evento recarregar a página
