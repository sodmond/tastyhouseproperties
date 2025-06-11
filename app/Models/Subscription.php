<?php

namespace App\Models;

use App\Mail\SubscriptionConfirmation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id', 'package_id', 'type', 'amount', 'start_date', 
        'end_date', 'gateway', 'reference', 'memo', 'product_id'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public static function storeSub($seller, $package, $reference, $amount)
    {
        $old_sub = Subscription::where('seller_id', $seller->id)->where('type', 'prime')->latest()->first();
        $curDate = date('Y-m-d');
        $subscription = new Subscription();
        $subscription->seller_id = $seller->id;
        $subscription->package_id = $package->id;
        $subscription->type = $package->type;
        $subscription->amount = $amount/100;
        $subscription->start_date = $curDate;
        $subscription->end_date = date("Y-m-d", strtotime("+$package->duration months", strtotime($curDate)));
        $subscription->gateway = 'paystack';
        $subscription->reference = $reference;
        $subscription->memo = '';
        if(isset($old_sub->id) && $package->type == 'prime') {
            if(!empty($old_sub->product_id)) {
                $subscription->product_id = $old_sub->product_id;
            }
        }
        $subscription->save();
        DB::commit();
        Mail::to($seller->email)->queue(new SubscriptionConfirmation($subscription));
        return true;
    }
}
