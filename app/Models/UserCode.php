<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class UserCode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'key'];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public static function genCode($user_id)
    {
        $key = rand(100000, 999999);
        UserCode::updateOrCreate(['user_id' => $user_id],
            ['key' => Hash::make($key)]);
        return $key;
    } 
}
