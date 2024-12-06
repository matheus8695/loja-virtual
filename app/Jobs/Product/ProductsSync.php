<?php

namespace App\Jobs\Product;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class ProductsSync implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiProducts = Http::get("https://fakestoreapi.in/api/products?limit=150")->json();

        foreach ($apiProducts["products"] as $product) {
            ProductsStore::dispatch($product);
        }
    }
}
