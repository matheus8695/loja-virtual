<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class State extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'acronym',
        'name',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
