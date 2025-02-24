<?php

namespace App\Services;

use App\Enum\Status;
use App\Models\{Order, Product, ProductOrder};
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getOrCreateOrder(): Order
    {
        try {
            return Order::query()->firstOrCreate([
                'user_id' => Auth::id(),
                'status'  => Status::OPEN,
            ]);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar ou buscar pedido' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function addProductToOrder(Product $product): void
    {
        try {
            $order = $this->getOrCreateOrder();

            ProductOrder::query()->updateOrCreate(
                ['order_id' => $order->id, 'product_id' => $product->id],
                ['quantity' => 1, 'price' => $product->price]
            );
        } catch (Exception $e) {
            throw new Exception('Erro ao adicionar produto ao pedido' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
