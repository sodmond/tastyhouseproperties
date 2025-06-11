<?php

namespace App\Http\Controllers\User;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatLog;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', auth('web')->id())->orderBy('user_read_status')->orderByDesc('created_at')->paginate(10);
        return view('user.chat.index', compact('chats'));
    }

    public function chat($id)
    {
        $chat = Chat::find($id);
        $chat->update(['user_read_status' => 1]);
        ChatLog::where('chat_id', $chat->id)->where('sender', 'seller')->update(['status' => 1]);
        $chatlog = ChatLog::where('chat_id', $chat->id)->get();
        return view('user.chat.single', compact('chat', 'chatlog'));
    }

    public function initiateChat(Request $request)
    {
        $this->validate($request, [
            'product_id' => ['required', 'array', 'min:1'],
            'product_id.*' => ['required', 'numeric'],
            'message' => ['nullable']
        ]);
        $products = Product::whereIn('id', $request->product_id); #dd($products->pluck('id'), $products->pluck('title'));
        $sellerId = $products->get()[0]->seller_id;
        $order = Order::where('user_id', auth('web')->id())->where('product_id', json_encode($products->pluck('id')))->first();
        $message = $request->message ?? "Hi, I'm Interested in your product.";
        try {
            if(! isset($order->id)) {
                $order = Order::create([
                    'code'              => Order::orderCode(),
                    'user_id'           => auth('web')->id(),
                    'product_id'        => json_encode($products->pluck('id')),
                    'product_name'      => json_encode($products->pluck('title')),
                    'amount'            => $products->sum('price'),
                ]);
                $chat = Chat::create([
                    'user_id'       => auth('web')->id(),
                    'seller_id'     => $sellerId,
                    'sender'        => 'seller',
                    'message'       => $message,
                    'order_id'      => $order->id
                ]);
                $chat_log = ChatLog::create([
                    'chat_id'       => $chat->id,
                    'sender'        => 'user',
                    'message'       => $message,
                ]);
                broadcast(new ChatSent($chat_log));
                return redirect()->route('user.message', ['id' => $chat->id]);
            }
            $chat = Chat::where('order_id', $order->id)->first();
            return redirect()->route('user.message', ['id' => $chat->id]);
        } catch(\Exception $e) {
            Log::info($e->getMessage());
            return back()->withErrors(['err_msg' => 'Problem encountered, pls try again']);
        }
    }

    public function sendMessage($id, Request $request)
    {
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);
        $chat = Chat::find($id);
        $chat->seller_read_status = 0;
        $chat_log = ChatLog::create([
            'chat_id'       => $chat->id,
            'sender'        => 'user',
            'message'       => $request->message,
        ]);
        $chat->save();
        broadcast(new ChatSent($chat_log));
        return response()->json(['chat' => $chat], 200);
    }
}
