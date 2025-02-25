<?php

namespace App\Actions;

use App\Enum\Status;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CreateOrder
{
    public static function execute(): int
    {
        $order = Order::query()->create([
            'user_id' => Auth::id(),
            'status'  => Status::OPEN,
        ]);

        return $order->id;
    }
}
