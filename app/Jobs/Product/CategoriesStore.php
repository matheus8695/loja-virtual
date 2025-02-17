<?php

namespace App\Jobs\Product;

use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class CategoriesStore implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiCategories = Http::get("https://fakestoreapi.in/api/products/category")->json();

        foreach ($apiCategories['categories'] as $category) {
            Category::create([
                "name" => $category,
            ]);
        }
    }
}
