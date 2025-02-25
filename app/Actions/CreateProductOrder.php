<?php

namespace App\Actions;

use App\Models\{Product, ProductOrder};

class CreateProductOrder
{
    public static function execute(int $productId, int $orderId): void
    {
        $product = self::getProduct($productId);

        ProductOrder::query()->create([
            'product_id' => $product->id,
            'order_id'   => $orderId,
            'quantity'   => 1,
            'price'      => $product->price,
        ]);
    }

    private static function getProduct(int $productId): Product
    {
        return Product::query()->findOrFail($productId);
    }
}
