<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, get};

test('should be able to access user-profile.show route', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    get(route('user-profile.index'))->assertOk();
});
