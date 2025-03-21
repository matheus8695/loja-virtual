<?php

namespace App\Services;

use App\Enum\Status;
use App\Models\{Order, Product, User};

class OrderService
{
    public function addProductToOrder(Product $product, User $user): Order
    {
        $order = $this->getOrCreateOpenOder($user);

        if (!$order->products->contains($product->id)) {
            $this->createProductOrder($product, $order);
        }

        return $order;
    }

    private function getOrCreateOpenOder(User $user): Order
    {
        return Order::query()->firstOrCreate([
            'user_id' => $user->id,
            'status'  => Status::OPEN,
        ]);
    }

    private function createProductOrder(Product $product, Order $order): void
    {
        $order->products()->attach($product->id, [
            'quantity' => 1,
            'price'    => $product->price,
        ]);
    }
}
