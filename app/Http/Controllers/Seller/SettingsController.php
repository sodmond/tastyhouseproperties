<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Unicodeveloper\Paystack\Facades\Paystack;

class SettingsController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $accountSub = Subscription::where('seller_id', auth('seller')->id())->where('type', 'general')->orderByDesc('created_at')->first();
        $primeSub = Subscription::where('seller_id', auth('seller')->id())->where('type', 'prime')->orderByDesc('created_at')->first();
        $products = Product::where('seller_id', auth('seller')->id())->get();
        return view('seller.settings', compact('packages', 'accountSub', 'primeSub', 'products'));
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'package' => ['required']
        ]);
        try {
            $package = Package::find($request->package);
            $data = [
                'amount'    => ($package->amount * 100),
                'email'     => auth('seller')->user()->email,
                'currency'  => 'NGN',
                'reference' => Paystack::genTranxRef(),
                'metadata' => [
                    'seller_id' => auth('seller')->id(),
                    'package_id' => $package->id
                ],
                'callback_url' => route('seller.payment.verify')
            ];
            $payment = new PaymentController;
            return $payment->redirectToGateway($data);
        } catch(\Exception $e) {
            Log::info('Package not found: ' . $e->getMessage());
            return back()->withErrors(['err_msg' => 'Problem encountered, pls try again']);
        }
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::where('seller_id', auth('seller')->id())->orderByDesc('created_at')->paginate(10);
        return view('seller.subscriptions', compact('subscriptions'));
    }

    public function primeProduct(Request $request)
    {
        $this->validate($request, [
            'products' => ['required', 'array', 'min:1', 'max:3'],
            'products.*' => ['required', 'integer', 'exists:products,id']
        ]);
        $primeSub = Subscription::where('seller_id', auth('seller')->id())->where('type', 'prime')->latest();
        if ($primeSub->first()->end_date > date('Y-m-d')) {
            Product::where('seller_id', auth('seller')->id())->update(['prime_status' => 0]);
            $primeSub->update(['product_id' => json_encode($request->products)]);
            Product::whereIn('id', $request->products)->update(['prime_status' => 1]);
            return back()->with('success', 'Your Prime Products has been updated');
        }
        return back()->withErrors(['err_msg' => "You don't have an active prime subscription"]);
    }
}
