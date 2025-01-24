<?php

use App\Livewire\UserProfile\Address\Delete;
use App\Models\{Address, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
});

it('should delete a address from authenticate user', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    actingAs($this->user);

    Livewire::test(Delete::class)
        ->set('address', $address)
        ->call('delete', $this->user->id)
        ->assertHasNoErrors();

    assertDatabaseMissing('addresses', ['id' => $address->id]);
});

test('should open modal to confirm the deletion', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(Delete::class)
        ->call('confirm', $this->user->id)
        ->assertSet('modal', true);
});

test('should close modal', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(Delete::class)
        ->set('address', $address)
        ->call('delete')
        ->assertSet('modal', false);
});

test('after deleting should dispatching an event to reload the addresses list', function () {
    $this->artisan('app:states-sync')->assertExitCode(0);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(Delete::class)
        ->set('address', $address)
        ->call('delete')
        ->assertDispatched('address::reload');
});
