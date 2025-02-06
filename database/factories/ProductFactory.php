<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => fn () => Category::first() ?? Category::factory()->create() ,
            'title'       => fake()->words('2'),
            'image'       => fake()->url(),
            'price'       => fake()->randomNumber(),
            'description' => fake()->text(),
            'brand'       => fake()->word(2),
            'quantity'    => fake()->randomNumber(),
        ];
    }
}
