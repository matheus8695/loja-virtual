<?php

use App\Livewire\Product;
use App\Models\{Product as ModelProduct, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be access the product route', function () {
    /** @var User $user */
    $user    = User::factory()->create();
    $product = ModelProduct::factory()->create();

    actingAs($user);

    Livewire::test(Product\Index::class, ['encodedId' => base64_encode($product->id)])
        ->assertOk();
});
