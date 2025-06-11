<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Seller;
use App\Models\Subscription;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $subscriptions = Subscription::where('code', $searchVal)->orderByDesc('created_at')->paginate(10);
            return view('admin.subscriptions.index', compact('subscriptions'));
        }
        $subscriptions = Subscription::orderByDesc('created_at')->paginate(10);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function get($id)
    {
        $subscription = Subscription::find($id);
        $seller = Seller::find($subscription->seller_id);
        return view('admin.subscriptions.single', compact('subscription', 'seller'));
    }

    public function verifyPayment(Request $request)
    {
        $this->validate($request, [
            'reference'=> ['required', 'string', 'max:50']
        ]);
        $subscriptions = Subscription::where('reference', $request->reference)->get();
        if ($subscriptions->count() > 0) {
            return back()->withErrors(['err_msg' => 'Subscription for reference number already activated.']);
        }
        $v = Http::withToken(config('paystack.secretKey'))->get(config('paystack.paymentUrl') . "/transaction/verify/$request->reference", []);
        Log::info($v);
        if ($v->successful()) {
            if ($v->json('data.status') == 'success') {
                $seller = Seller::find($v->json('data.metadata.seller_id'));
                $package = Package::find($v->json('data.metadata.package_id'));
                $reference = $v->json('data.reference');
                $amount = $v->json('data.amount');
                DB::beginTransaction();
                Subscription::storeSub($seller, $package, $reference, $amount);
                return back()->with('success', 'Payment verified and subscription activated');
            }
            return back()->withErrors(['err_msg' => 'The payment was not completed']);
        }
        return back()->withErrors(['err_msg' => 'Invalid payment reference number']);
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
