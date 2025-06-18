<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'user_id', 'product_id', 'product_name', 'amount', 'quantity',
        'delivery_option', 'delivery_address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function orderCode()
    {
        $prefix = 'THP_';
        return  $prefix . time() . strtoupper(Str::random(4));
    }
}
