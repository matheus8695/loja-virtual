<?php

use App\Livewire\UserProfile\PersonalData\Show;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should render the component', function () {
    Livewire::test(Show::class)
        ->assertOk();
});

it('should make sure that we can see the personal data from authenticate user on screen', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(Show::class)
        ->assertSee($user->name)
        ->assertSee($user->email)
        ->assertSee($user->document_id)
        ->assertSee($user->gender)
        ->assertSee($user->phone_number)
        ->assertSee($user->name);
});
