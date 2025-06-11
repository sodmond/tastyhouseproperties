<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'seller_id', 'sender', 'message', 'order_id', 'user_read_status', 'seller_read_status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function chatlog(): HasMany
    {
        return $this->hasMany(ChatLog::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function unreadMsgCount($userType, $user_id)
    {
        $user_field = ($userType == 'seller') ? 'seller_id' : 'user_id';
        $sender = ($userType == 'seller') ? 'user' : 'seller';
        $chat = Chat::where($user_field, $user_id)->pluck('id');
        $chatlog = ChatLog::whereIn('chat_id', $chat)->where('sender', $sender)->where('status', 0)->get(); #dd($chatlog);
        return $chatlog->count();
    }
}
