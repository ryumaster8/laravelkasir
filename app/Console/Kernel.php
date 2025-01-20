<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run cleanup daily at midnight
        $schedule->command('transactions:cleanup-held')
                ->daily()
                ->at('00:00')
                ->appendOutputTo(storage_path('logs/held-transactions-cleanup.log'));

        // Check expiring memberships daily at 8 AM
        $schedule->command('membership:check-expiring')
                ->dailyAt('08:00')
                ->withoutOverlapping();
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
