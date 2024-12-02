<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductOrder extends Model
{
    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "price",
        "status",
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
