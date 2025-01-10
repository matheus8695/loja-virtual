<?php

use App\Livewire\UserProfile\PersonalData;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be able to update a authenticate user', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(PersonalData\Update::class)
        ->call('load', $user->id)
        ->set('name', 'name test')
        ->set('email', 'email@test.com')
        ->set('email_confirmation', 'email@test.com')
        ->set('document_id', '11111111111')
        ->set('phone_number', '00000000000')
        ->set('gender', 'male')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'id'           => $user->id,
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
            ->set('name', $field->value)
            ->call('save')
            ->assertHasErrors(['name' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255'  => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    /** EMAIL */
    test('email rules', function ($field) {
        if ($field->rule == 'unique') {
            User::factory()->create(['email' => $field->value]);
        }

        $livewire = Livewire::test(PersonalData\Update::class)->set('email', $field->value);

        if (property_exists($field, 'aValue')) {
            $livewire->set($field->aField, $field->aValue);
        }

        $livewire->call('save')->assertHasErrors(['email' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255'  => (object)['value' => str_repeat('*', 256), 'rule' => 'max'],
        'email'    => (object)['value' => 'not-an-email', 'rule' => 'email'],
        'unique'   => (object)['value' => 'user@test.com', 'rule' => 'unique', 'aField' => "email_confirmation", 'aValue' => 'user@test.com'],
    ]);

    /** DOCUMENT_ID */
    test('document_id rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->set('document_id', $field->value)
            ->call('save')
            ->assertHasErrors(['document_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11'  => (object)['value' => '*', 'rule' => 'size'],
    ]);

    /** PHONE NUMBER */
    test('phone_number rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->set('phone_number', $field->value)
            ->call('save')
            ->assertHasErrors(['phone_number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11'  => (object)['value' => '*', 'rule' => 'size'],
    ]);

    /** GENDER */
    test('gender rules', function ($field) {
        Livewire::test(PersonalData\Update::class)
            ->set('gender', $field->value)
            ->call('save')
            ->assertHasErrors(['gender' => $field->rule]);
    })->with([
        'required'                  => (object)['value' => '', 'rule' => 'required'],
        'size:in:male,female,other' => (object)['value' => 'teste', 'rule' => 'in'],
    ]);
});
