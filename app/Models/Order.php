<?php

namespace App\Models;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status",
        "price",
    ];

    protected $casts = [
        "status" => Status::class,
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_orders', 'order_id', 'product_id')
            ->using(ProductOrder::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function hasProduct(int $productId): bool
    {
        return ProductOrder::query()
            ->where('order_id', $this->id)
            ->where('product_id', $productId)
            ->exists();
    }
}
