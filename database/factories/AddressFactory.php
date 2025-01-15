<?php

namespace Database\Factories;

use App\Models\{State};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "zip_code"   => fake()->postcode(),
            "city"       => fake()->city(),
            "district"   => fake()->randomElement(['Centro', 'Maria Lucia', 'Gleba Palhano']),
            "state_id"   => State::query()->inRandomOrder()->first("id"),
            "street"     => fake()->streetName(),
            "number"     => fake()->numberBetween(0, 999),
            "complement" => fake()->boolean() ? fake()->sentence(10) : null,
        ];
    }

    public function withUser(int $id): self
    {
        return $this->state(fn (array $attributes) => [
            "user_id" => $id,
        ]);
    }
}
