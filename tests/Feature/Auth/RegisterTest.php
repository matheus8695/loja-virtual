<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it("should render  the component", function () {
    Livewire::test(Register::class)->assertOk();
});

it('should be able to register a new user', function () {
    Livewire::test(Register::class)
        ->set("name", "user test")
        ->set("email", "user@test.com")
        ->set("email_confirmation", "user@test.com")
        ->set("password", "password")
        ->set("document_id", "10410413900")
        ->set("phone_number", "43988232910")
        ->set("gender", "male")
        ->call("submit")
        ->assertHasNoErrors();
        
        assertDatabaseHas("users", [
            "name" => "user test",
            "email" => "user@test.com"
        ]);

        assertDatabaseCount("users", 1);
});
