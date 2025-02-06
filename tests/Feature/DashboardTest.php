<?php

use App\Livewire\Dashboard;
use App\Models\{Category, Product, User};
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    /** @var User $user */
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should access the dashboard route', function () {
    $response = $this->get(route('dashboard'));
    $response->assertStatus(200);
});

it('should see products data on the dashboard', function () {
    $this->artisan('app:categories-command')->assertExitCode(0);
    $this->artisan('app:products-command')->assertExitCode(0);

    $product = Product::first();

    Livewire::test(Dashboard::class)
        ->assertSee(implode(' ', array_slice(explode(' ', $product->title), 0, 4)))
        ->assertSee($product->image)
        ->assertSee(number_format($product->price / 100, 2));
});

describe('filters', function () {
    test('filter by title', function () {
        $product1 = Product::factory()->create(['title' => 'macbook']);
        $product2 = Product::factory()->create(['title' => 'notebook']);

        Livewire::test(Dashboard::class)
            ->assertSee($product1->title)
            ->assertSee($product2->title)
            ->set('search', 'mac')
            ->assertSee($product1->title)
            ->assertDontSee($product2->title);
    });

    test('filter by category', function () {
        $category1 = Category::factory()->create(['name' => 'gaming']);
        $category2 = Category::factory()->create(['name' => 'laptop']);

        $product1 = Product::factory()->create(['title' => 'Xbox', 'category_id' => $category1->id]);
        $product2 = Product::factory()->create(['title' => 'MacBook', 'category_id' => $category2->id]);

        Livewire::test(Dashboard::class)
            ->assertSee($product1->title)
            ->assertSee($product2->title)
            ->set('searchByCategory', $category2->id)
            ->assertSee($product2->title)
            ->assertDontSee($product1->title);
    });
});
