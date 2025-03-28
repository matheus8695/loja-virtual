<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
use Illuminate\Support\Collection;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        "category_id",
        "title",
        "image",
        "price",
        "description",
        "quantity",
        "brand",
    ];

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany<Order, $this>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'product_orders', 'product_id', 'order_id')
            ->using(ProductOrder::class)
            ->withPivot('quantity', 'price', 'status')
            ->withTimestamps();
    }

    /**
     * @return Collection<int, $this>
     */
    public static function getByOrderId(int $orderId): Collection
    {
        return Product::query()
            ->join('product_orders as po', 'po.product_id', '=', 'products.id')
            ->where('po.order_id', $orderId)
            ->select(['products.*', 'po.id as product_order_id', 'po.price'])
            ->get();
    }
}
