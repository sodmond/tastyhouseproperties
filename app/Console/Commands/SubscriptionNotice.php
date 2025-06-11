<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionReminder;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Subscription;
use App\Models\THC\Product as THCProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscriptionNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Subcription expiration cron started!');
        $sellers = Seller::all()->keyBy('id');
        Subscription::whereRaw('end_date = CURDATE()')
            ->lazyById()->each(function ($task) use($sellers) {
                $seller = $sellers[$task->seller_id];
                Product::where('seller_id', $seller->id)->update(['prime_status' => 0]);
                THCProduct::where('seller_id', $seller->id)->update(['prime_status' => 0]);
                Mail::to($seller->email)->send(new SubscriptionReminder($task->type, 0));
            }
        );
        Log::info('Subcription expiration cron ended!');
    }
}
