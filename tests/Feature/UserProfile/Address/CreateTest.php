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
        ->set('form.zip_code', '86072460')
        ->set('form.state_id', $stateId)
        ->set('form.district', 'Maria Lúcia')
        ->set('form.city', 'Londrina')
        ->set('form.street', 'Eiti Sugmoto')
        ->set('form.number', 20)
        ->set('form.complement', 'Próximo a academia DNA')
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
            ->set('form.zip_code', $field->value)
            ->call('create')
            ->assertHasErrors(['form.zip_code' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 9), 'rule' => 'max:8'],
    ]);

    test('state id rules', function ($field) {
        $this->artisan('app:states-sync')->assertExitCode(0);

        Livewire::test(Address\Create::class)
            ->set('form.state_id', $field->value)
            ->call('create')
            ->assertHasErrors(['form.state_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'exists'   => (object)['value' => 30, 'rule' => 'exists:states,id'],
    ]);

    test('city rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('form.city', $field->value)
            ->call('create')
            ->assertHasErrors(['form.city' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('district rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('form.district', $field->value)
            ->call('create')
            ->assertHasErrors(['form.district' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('street rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('form.street', $field->value)
            ->call('create')
            ->assertHasErrors(['form.street' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max'      => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    test('number rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('form.number', $field->value)
            ->call('create')
            ->assertHasErrors(['form.number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
    ]);

    test('complement rules', function ($field) {
        Livewire::test(Address\Create::class)
            ->set('form.complement', $field->value)
            ->call('create')
            ->assertHasErrors(['form.complement' => $field->rule]);
    })->with([
        'max' => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);
});
