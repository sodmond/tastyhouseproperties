<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionReminder;
use App\Models\Seller;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscriptionNoticeThree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-notice-three';

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
        Log::info('3 days Subscription expiration cron started!');
        $sellers = Seller::all()->keyBy('id');
        Subscription::whereRaw('DATE_ADD(CURDATE(), INTERVAL 3 DAY) = end_date')
            ->lazyById()->each(function ($task) use($sellers) {
                $seller = $sellers[$task->seller_id];
                Mail::to($seller->email)->send(new SubscriptionReminder($task->type, 3));
            }
        );
        Log::info('3 days Subcription expiration cron ended!');
    }
}
