<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'categories', 'values', 'option_type'
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(ProductTag::class);
    }
}
