<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $orders = Order::where('code', $searchVal)->orderByDesc('created_at')->paginate(10);
            return view('admin.orders.index', compact('orders'));
        }
        $orders = Order::orderByDesc('created_at')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function get($id)
    {
        $order = Order::find($id);
        $chat = Chat::where('order_id', $order->id)->first();
        $seller = Seller::find($chat->seller_id);
        $product = Product::whereIn('id', json_decode($order->product_id))->first();
        return view('admin.orders.single', compact('order', 'seller', 'product'));
    }

    public function export()
    {
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');
            $fileName = 'orders-'.$monthName.$year.'.xlsx';
            return Excel::download(new OrdersExport($month, $year), $fileName);
        }
        return redirect()->back();
    }
}
