<?php

use App\Livewire\Auth\Logout;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    Livewire::test(Logout::class)
        ->assertStatus(200);
});

it('should be able to logout', function () {
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(Logout::class)
        ->call('logout')
        ->assertRedirect(route('login'));

    expect(auth())->guest()->toBeTrue();

});
