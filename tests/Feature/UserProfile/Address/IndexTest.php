<?php

use App\Livewire\UserProfile\Address\Index;
use App\Models\{Address, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should render the component', function () {
    Livewire::test(Index::class)
        ->assertOk();
});

it('should show the address in the screen if the user has a registered address ', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(Index::class)
        ->assertSee($address->zip_code)
        ->assertSee($address->city)
        ->assertSee($address->district)
        ->assertSee($address->state->name)
        ->assertSee($address->number);
});

it('should show a message in the screen when the user dont have a registered address', function () {
    Livewire::test(Index::class)->assertSee('Nenhum endereço cadastrado');
});
