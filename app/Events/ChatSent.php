<?php

namespace App\Events;

use App\Models\ChatLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChatSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $receiver;
    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatLog $chatlog)
    {
        $chat = $chatlog->chat;
        $this->receiver = ($chatlog->sender == 'seller') ? $chat->user_id : $chat->seller_id ;
        $this->chat = [
            'id'            => $chat->id,
            'user_id'       => $chat->user_id,
            'seller_id'     => $chat->seller_id,
            'message'       => $chatlog->message,
            'sender'        => $chatlog->sender,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("chat"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.sent';
    }

    public function broadcastWith(): array
    {
        #Log::info('Chat Message', $this->chat);

        return $this->chat;
    }
}
