<?php

namespace App\Http\Controllers\Seller;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatLog;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['seller.verify', 'seller.subcheck']);
    }
    public function index()
    {
        $chats = Chat::where('seller_id', auth('seller')->id())->orderBy('seller_read_status')->orderByDesc('created_at')->paginate(10);
        return view('seller.chat.index', compact('chats'));
    }

    public function chat($id)
    {
        $chat = Chat::find($id);
        $chat->update(['seller_read_status' => 1]);
        ChatLog::where('chat_id', $chat->id)->where('sender', 'user')->update(['status' => 1]);
        $chatlog = ChatLog::where('chat_id', $chat->id)->get();
        return view('seller.chat.single', compact('chat', 'chatlog'));
    }

    public function sendMessage($id, Request $request)
    {
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);
        $chat = Chat::find($id);
        $chat->user_read_status = 0;
        $chat_log = ChatLog::create([
            'chat_id'       => $chat->id,
            'sender'        => 'seller',
            'message'       => $request->message,
        ]);
        $chat->save();
        broadcast(new ChatSent($chat_log));
        return response()->json(['chat' => $chat], 200);
    }
}
