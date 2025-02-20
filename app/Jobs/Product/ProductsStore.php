<?php

namespace App\Jobs\Product;

use App\Models\{Category, Product};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductsStore implements ShouldQueue
{
    use Queueable;

    /**
     * @param array<string, int> $product
     * @return void
     */
    public function __construct(public array $product)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Product::create([
            "title"       => $this->product["title"],
            "image"       => $this->product["image"],
            "category_id" => Category::where("name", $this->product["category"])->value("id"),
            "brand"       => $this->product["brand"],
            "price"       => $this->product["price"] * 100,
            "description" => $this->product["description"],
            "quantity"    => random_int(10, 100),
        ]);
    }
}
