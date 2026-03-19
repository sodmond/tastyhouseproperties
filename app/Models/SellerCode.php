<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class SellerCode extends Model
{
    use HasFactory;

    protected $fillable = ['seller_id', 'key'];

    public function seller() : BelongsTo 
    {
        return $this->belongsTo(Seller::class);
    }

    public static function genCode($seller_id)
    {
        $key = rand(100000, 999999);
        SellerCode::updateOrCreate(['seller_id' => $seller_id],
            ['key' => Hash::make($key)]);
        return $key;
    }
}
