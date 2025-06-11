<?php

namespace App\Listeners;

use App\Events\ChatSent;
use App\Mail\SendNewChatEmail;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ChatNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChatSent $event): void
    {
        $chat = $event->chat;
        $recepient = '';
        $sender = '';
        if ($chat['sender'] == 'seller') {
            $recepient = User::find($chat['user_id']);
            $sender = 'vendor';
        } else {
            $recepient = Seller::find($chat['seller_id']);
            $sender = 'user';
        }
        Mail::to($recepient->email)->send(new SendNewChatEmail($recepient->firstname, $sender));
        #Log::info(($chat['sender']));
    }
}
