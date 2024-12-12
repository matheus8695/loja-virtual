<?php

use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it("should render the component", function () {
    Livewire::test(Register::class)->assertOk();
});

it('should be able to register a new', function () {
    Livewire::test(Register::class)
        ->set("name", "user test")
        ->set("email", "user@test.com")
        ->set("email_confirmation", "user@test.com")
        ->set("password", "password")
        ->set("document_id", "10410413900")
        ->set("phone_number", "43988232910")
        ->set("gender", "male")
        ->call("submit")
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard'));
        
        assertDatabaseHas("users", [
            "name" => "user test",
            "email" => "user@test.com"
        ]);

        assertDatabaseCount("users", 1);

        expect(Auth::check())
            ->and(Auth::user())
            ->id->toBe(User::first()->id);
});

describe('validations', function () {
    /** NAME */
    test('name rules', function ($field) {
        Livewire::test(Register::class)
            ->set('name',$field->value)
            ->call('submit')
            ->assertHasErrors(['name' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255' => (object)['value' => str_repeat('*', 256), 'rule' => 'max:255'],
    ]);

    /** EMAIL */
    test('email rules', function ($field) {
        if ($field->rule == 'unique') {
            User::factory()->create(['email' => $field->value]);
        }

        Livewire::test(Register::class)
            ->set('email',$field->value)
            ->call('submit')
            ->assertHasErrors(['email' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'max:255' => (object)['value' => str_repeat('*', 256), 'rule' => 'max'],
        'email' => (object)['value' => 'not-an-email', 'rule' => 'email'],
        'unique' => (object)['value' => 'user@test.com', 'rule' => 'unique'],
    ]);

    /** PASSWORD */
    test('password rules', function ($field) {
        Livewire::test(Register::class)
            ->set('password',$field->value)
            ->call('submit')
            ->assertHasErrors(['password' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'min:6' => (object)['value' => '*', 'rule' => 'min']
    ]);

    /** DOCUMENT_ID */
    test('document_id rules', function ($field) {
        Livewire::test(Register::class)
            ->set('document_id',$field->value)
            ->call('submit')
            ->assertHasErrors(['document_id' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11' => (object)['value' => '*', 'rule' => 'size']
    ]);

    /** PHONE NUMBER */
    test('phone_number rules', function ($field) {
        Livewire::test(Register::class)
            ->set('phone_number',$field->value)
            ->call('submit')
            ->assertHasErrors(['phone_number' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:11' => (object)['value' => '*', 'rule' => 'size']
    ]);

    /** GENDER */
    test('gender rules', function ($field) {
        Livewire::test(Register::class)
            ->set('gender',$field->value)
            ->call('submit')
            ->assertHasErrors(['gender' => $field->rule]);
    })->with([
        'required' => (object)['value' => '', 'rule' => 'required'],
        'size:in:male,female,other' => (object)['value' => 'teste', 'rule' => 'in']
    ]);
});

