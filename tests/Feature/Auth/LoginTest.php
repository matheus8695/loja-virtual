<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

it("render successfully", function () {
    Livewire::test(Login::class)
        ->assertOk();
});

it("should be able to login", function () {
    $user = User::factory()->create([
        'email'    => 'email@teste.com',
        'password' => 'password',
    ]);

    Livewire::test(Login::class)
        ->set("email", "email@teste.com")
        ->set('password', "password")
        ->call("login")
        ->assertHasNoErrors()
        ->assertRedirect(route("dashboard"));

    expect(auth()->check())->toBeTrue()
        ->and(auth()->user()->id)->toBe($user->id);
});

it('should inform the user an error when email and password not work', function () {
    Livewire::test(Login::class)
        ->set("email", "email@teste.com")
        ->set('password', "password")
        ->call("login")
        ->assertHasErrors(['invalidCredentials'])
        ->assertSee(trans("auth.failed"));
});

it('should make sure that the rate limiting is blocking after 5 attempts', function () {
    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        Livewire::test(Login::class)
        ->set("email", $user->email)
        ->set('password', "wrong-password")
        ->call("login")
        ->assertHasErrors(['invalidCredentials']);
    }

    Livewire::test(Login::class)
        ->set("email", $user->email)
        ->set('password', "wrong-password")
        ->call("login")
        ->assertHasErrors(['rateLimiter']);
});
