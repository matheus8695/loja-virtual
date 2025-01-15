<?php

use App\Livewire\UserProfile\PersonalData;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should be able to update a authenticate user', function () {
    Livewire::test(PersonalData\Update::class)
        ->call('load', $this->user->id)
        ->set('user.name', 'name test')
        ->set('user.email', 'email@test.com')
        ->set('user.document_id', '11111111111')
        ->set('user.phone_number', '00000000000')
        ->set('user.gender', 'male')
        ->assertSet('modal', true)
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'id'           => $this->user->id,
        'name'         => 'name test',
        'email'        => 'email@test.com',
        'document_id'  => '11111111111',
        'phone_number' => '00000000000',
        'gender'       => 'male',
    ]);
});

describe('validations', function () {
    /** NAME */
    test('name rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->call('load', $this->user->id)
            ->set('user.name', $field->value)
            ->call('save')
            ->assertHasErrors(['user.name' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255'  => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    /** EMAIL */
    test('email rules', function ($field) {
        if ($field->rule == 'unique') {
            User::factory()->create(['email' => $field->value]);
        }

        $livewire = Livewire::test(PersonalData\Update::class)
            ->call('load', $this->user->id)
            ->set('user.email', $field->value);

        if (property_exists($field, 'aValue')) {
            $livewire->set($field->aField, $field->aValue);
        }

        $livewire->call('save')->assertHasErrors(['user.email' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255'  => (object)['value' => str_repeat('*', 256), 'rule' => 'max'],
        'email'    => (object)['value' => 'not-an-email', 'rule' => 'email'],
        'unique'   => (object)['value' => 'user@test.com', 'rule' => 'unique'],
    ]);

    /** DOCUMENT_ID */
    test('document_id rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->call('load', $this->user->id)
            ->set('user.document_id', $field->value)
            ->call('save')
            ->assertHasErrors(['user.document_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11'  => (object)['value' => '*', 'rule' => 'size'],
    ]);

    /** PHONE NUMBER */
    test('phone_number rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->call('load', $this->user->id)
            ->set('user.phone_number', $field->value)
            ->call('save')
            ->assertHasErrors(['user.phone_number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11'  => (object)['value' => '*', 'rule' => 'size'],
    ]);

    /** GENDER */
    test('gender rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->call('load', $this->user->id)
            ->set('user.gender', $field->value)
            ->call('save')
            ->assertHasErrors(['user.gender' => $field->rule]);
    })->with([
        'required'                  => (object)['value' => '', 'rule' => 'required'],
        'size:in:male,female,other' => (object)['value' => 'teste', 'rule' => 'in'],
    ]);
});
