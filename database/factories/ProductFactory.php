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
            'title'       => fake()->sentence('4'),
            'image'       => fake()->url(),
            'price'       => fake()->randomNumber(),
            'description' => fake()->text(),
            'brand'       => fake()->sentence('1'),
            'quantity'    => fake()->randomNumber(),
        ];
    }
}
