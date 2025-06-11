<?php

namespace App\Http\Controllers\Admin\THC;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Order;
use App\Models\THC\Product;
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
            $orders = Order::where('code', 'LIKE', 'THC_%')->where('code', $searchVal)->orderByDesc('created_at')->paginate(10);
            return view('admin.thc.orders.index', compact('orders'));
        }
        $orders = Order::where('code', 'LIKE', 'THC_%')->orderByDesc('created_at')->paginate(10);
        return view('admin.thc.orders.index', compact('orders'));
    }

    public function get($id)
    {
        $order = Order::find($id);
        $chat = Chat::where('order_id', $order->id)->first();
        $seller = Seller::find($chat->seller_id);
        $products = Product::whereIn('id', json_decode($order->product_id))->get();
        return view('admin.thc.orders.single', compact('order', 'seller', 'products'));
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
