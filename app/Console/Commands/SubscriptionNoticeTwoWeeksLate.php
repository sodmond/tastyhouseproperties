<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionReminder;
use App\Models\Seller;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscriptionNoticeTwoWeeksLate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-notice-two-weeks-late';

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
        Log::info('14 days Late Subscription expiration cron started!');
        $sellers = Seller::all()->keyBy('id');
        Subscription::whereRaw('DATE_SUB(CURDATE(), INTERVAL 14 DAY) = end_date')
            ->lazyById()->each(function ($task) use($sellers) {
                $seller = $sellers[$task->seller_id];
                Mail::to($seller->email)->send(new SubscriptionReminder($task->type, -14));
            }
        );
        Log::info('14 days Late Subcription expiration cron ended!');
    }
}
