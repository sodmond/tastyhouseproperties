<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    public function cities() : HasMany
    {
        return $this->hasMany(City::class);
    }

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class, 'state');
    }
}
