<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SellersExport;
use App\Http\Controllers\Controller;
use App\Mail\ApprovalStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Subscription;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SellerController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $searchArr = explode(' ', $searchVal);
            $sellers = Seller::whereIn('firstname', $searchArr)->orWhereIn('lastname', $searchArr)->orWhereIn('companyname', $searchArr)
                ->orWhere('email', $searchVal)->orderByDesc('created_at')->paginate(10);
            return view('admin.sellers.index', compact('sellers'));
        }
        $sellers = Seller::orderByDesc('created_at')->paginate(10);
        $sellers_pending = Seller::where('approval', false);
        return view('admin.sellers.index', compact('sellers', 'sellers_pending'));
    }

    /*public function pending()
    {
        $sellers = seller::where('approval', false)->paginate(10);
        return view('admin.sellers.pending', compact('sellers'));
    }*/

    public function get($id)
    {
        $seller = Seller::find($id);
        return view('admin.sellers.single', compact('seller'));
    }

    /*public function approval($id, Request $request)
    {
        $this->validate($request, [
            'status' => 'required|integer'
        ]);
        $seller = Seller::find($id);
        if ($request->status == 1) {
            $seller->update(['approval' => 1]);
            Mail::to($seller->email)->send(new ApprovalStatus(1));
            return back()->with('success', 'seller has been notified of profile approval.');
        }
        if ($request->status == 0) {
            Mail::to($seller->email)->send(new ApprovalStatus(0));
            return back()->with('success', 'seller has been notified of profile decline.');
        }
    }*/

    public function export()
    {
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');
            $fileName = 'sellers-'.$monthName.$year.'.xlsx';
            return Excel::download(new SellersExport($month, $year), $fileName);
        }
        return redirect()->back();
    }

    public function subscriptions($id)
    {
        $subscriptions = Subscription::where('seller_id', $id)->orderByDesc('created_at')->paginate(10);
        $seller = Seller::find($id);
        return view('admin.sellers.subscriptions', compact('subscriptions', 'seller'));
    }

    public function products($id)
    {
        $seller = Seller::find($id);
        $products = Product::where('seller_id', $id)->orderByDesc('created_at')->paginate(10);
        return view('admin.sellers.products', compact('products', 'seller'));
    }

    /*public function sales($id)
    {
        $seller = seller::find($id);
        $earnings = Earning::where('seller_id', $id)->orderByDesc('created_at')->paginate(10);
        $orders = Order::all()->keyBy('id');
        return view('admin.revenue.earnings', compact('earnings', 'orders', 'seller'));
    }*/

    public function ban($id)
    {
        $seller = Seller::find($id);
        if ($seller) {
            if ($seller->status == true) {
                $seller->status = false;
                $seller->save();
                return back()->withErrors(['err_msg' => 'Vendor has been banned']);
            }
            $seller->status = true;
            $seller->save();
            return back()->with('success', 'Vendor ban has been lifted');
        }
        return redirect()->route('admin.home');
    }
}
