<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\QoreIDToken::class
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('qoreid:get-token')->hourly()->runInBackground()->evenInMaintenanceMode();
        $schedule->command('app:subscription-notice')->dailyAt('00:00')->runInBackground()->evenInMaintenanceMode();
        $schedule->command('app:subscription-notice-three')->dailyAt('01:00')->runInBackground()->evenInMaintenanceMode();
        $schedule->command('app:subscription-notice-two-weeks-late')->dailyAt('02:00')->runInBackground()->evenInMaintenanceMode();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
