<?php

use App\Livewire\UserProfile\Address;

use App\Models\{State, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

// criar um endereço
it('should be able to create a new address for authenticate user', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $stateId = State::first()->id;

    Livewire::test(Address\Create::class)
        ->set('zip_code', '86072460')
        ->set('state_id', $stateId)
        ->set('district', 'Maria Lúcia')
        ->set('city', 'Londrina')
        ->set('street', 'Eiti Sugmoto')
        ->set('number', 20)
        ->set('complement', 'Próximo a academia DNA')
        ->call("create")
        ->assertHasNoErrors();

    assertDatabaseHas('addresses', [
        'user_id'    => $this->user->id,
        'zip_code'   => '86072460',
        'state_id'   => $stateId,
        'district'   => 'Maria Lúcia',
        'city'       => 'Londrina',
        'street'     => 'Eiti Sugmoto',
        'number'     => 20,
        'complement' => 'Próximo a academia DNA',
    ]);
});

// validações
describe('validations', function () {
    test('zip code rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('zip_code', $field->value)
            ->call('create')
            ->assertHasErrors(['zip_code' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 9), 'rule' => 'max:8'],
    ]);

    test('state id rules', function ($field) {
        $this->artisan('app:states-sync')->assertExitCode(0);

        Livewire::test(Address\Create::class)
            ->set('state_id', $field->value)
            ->call('create')
            ->assertHasErrors(['state_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'exists'   => (object)['value' => 30, 'rule' => 'exists:states,id'],
    ]);

    test('city rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('city', $field->value)
            ->call('create')
            ->assertHasErrors(['city' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('district rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('district', $field->value)
            ->call('create')
            ->assertHasErrors(['district' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('street rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('street', $field->value)
            ->call('create')
            ->assertHasErrors(['street' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('number rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('number', $field->value)
            ->call('create')
            ->assertHasErrors(['number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
    ]);

    test('complement rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('complement', $field->value)
            ->call('create')
            ->assertHasErrors(['complement' => $field->rule]);
    })->with([
        'max' => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);
});
