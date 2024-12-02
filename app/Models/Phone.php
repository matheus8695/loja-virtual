<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    /** @use HasFactory<\Database\Factories\PhoneFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "number",
        "type",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
