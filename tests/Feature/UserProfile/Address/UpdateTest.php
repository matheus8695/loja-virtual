<?php

use App\Livewire\UserProfile\Address\Update;
use App\Models\{Address, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    $this->artisan('app:states-sync')->assertExitCode(0);

    /** @var User $user */
    $this->user    = User::factory()->create();
    $this->address = Address::factory()->create(['user_id' => $this->user->id]);

    actingAs($this->user);
});

it('should be able to update a address', function () {

    Livewire::test(Update::class)
        ->call('load', $this->address->id)
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
        'id'         => $this->address->id,
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
it('should open a drawer to update an address', function () {
    Livewire::test(Update::class)
        ->call('load', $this->address->id)
        ->assertSet('modal', true);
});

// fechar o drawer depois de editar

// enviar um evento recarregar a página
