<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, Pivot};

class ProductOrder extends Pivot
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $table = 'product_orders';

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "price",
        "status",
    ];

    /**
     * @return BelongsTo<Order, $this>
     */
    public function orders(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function products(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }
}
