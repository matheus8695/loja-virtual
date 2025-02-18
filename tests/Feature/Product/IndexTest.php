<?php

use App\Livewire\Product;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be access the product route', function () {
    /** @var User $user */
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test(Product\Index::class)
        ->assertOk();
});
