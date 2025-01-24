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
describe('validations', function () {
    test('zip code rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.zip_code', $field->value)
            ->call('update')
            ->assertHasErrors(['form.zip_code' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 9), 'rule' => 'max:8'],
    ]);

    test('state id rules', function ($field) {
        $this->artisan('app:states-sync')->assertExitCode(0);

        Livewire::test(Update::class)
            ->set('form.state_id', $field->value)
            ->call('update')
            ->assertHasErrors(['form.state_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'exists'   => (object)['value' => 30, 'rule' => 'exists:states,id'],
    ]);

    test('city rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.city', $field->value)
            ->call('update')
            ->assertHasErrors(['form.city' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('district rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.district', $field->value)
            ->call('update')
            ->assertHasErrors(['form.district' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('street rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.street', $field->value)
            ->call('update')
            ->assertHasErrors(['form.street' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('number rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.number', $field->value)
            ->call('update')
            ->assertHasErrors(['form.number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
    ]);

    test('complement rules', function ($field) {
        Livewire::test(Update::class)
            ->set('form.complement', $field->value)
            ->call('update')
            ->assertHasErrors(['form.complement' => $field->rule]);
    })->with([
        'max' => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);
});

// abrir um drawer para editar o endereço

// fechar o drawer depois de editar

// enviar um evento recarregar a página
