<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionConfirmation;
use App\Models\Package;
use App\Models\Seller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway($data)
    {
        try {
            $paymentUrl = Paystack::getAuthorizationUrl($data); #dd($paymentUrl->url);
            #Order::where('id', $data['metadata']['order_id'])->update(['payment_link' => $paymentUrl->url]);
            return $paymentUrl->redirectNow();
        } catch (\Exception $e) {#dd('paystack failed');
            Log::info($e->getMessage());
            return back()->withErrors(['paystack_err' => 'The paystack token has expired. Please refresh the page and try again.']);
        }
    }

    public function handleGatewayCallback()
    {
        $payment = Paystack::getPaymentData();
        $paymentData = $payment['data'];
        $paymentMeta = $payment['data']['metadata'];
        if ($payment['status'] == true) {
            #$old_sub = Subscription::where('seller_id', $paymentMeta['seller_id'])->where('type', 'prime')->latest()->first();
            $subscriptions = Subscription::where('reference', $paymentData['reference'])->get();
            $seller = Seller::find($paymentMeta['seller_id']);
            $package = Package::find($paymentMeta['package_id']);
            DB::beginTransaction();
            if ($subscriptions->count() < 1) {
                /*$curDate = date('Y-m-d');
                $subscription = new Subscription();
                $subscription->seller_id = $seller->id;
                $subscription->package_id = $package->id;
                $subscription->type = $package->type;
                $subscription->amount = $paymentData['amount']/100;
                $subscription->start_date = $curDate;
                $subscription->end_date = date("Y-m-d", strtotime("+$package->duration months", strtotime($curDate)));
                $subscription->gateway = 'paystack';
                $subscription->reference = $paymentData['reference'];
                $subscription->memo = '';
                if(isset($old_sub->id) && $package->type == 'prime') {
                    if(!empty($old_sub->product_id)) {
                        $subscription->product_id = $old_sub->product_id;
                    }
                }
                $subscription->save();
                DB::commit();
                Mail::to($seller->email)->queue(new SubscriptionConfirmation($subscription));*/
                Subscription::storeSub($seller, $package, $paymentData['reference'], $paymentData['amount']);
                return redirect()->route('seller.settings')->with('success', 'Your subscription payment is completed');
            }
            DB::rollBack();
            return redirect()->route('seller.settings')->with('success', 'Your subscription payment is completed');
        }
        return redirect()->route('seller.settings')->withErrors(['payment_err', "Payment couldn't be completed, pls try again."]);
    }
}
