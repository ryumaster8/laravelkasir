<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\ModelHeldTransaction;
use Illuminate\Support\Facades\Log;

class CleanupHeldTransactions extends Command
{
    protected $signature = 'transactions:cleanup-held {--days=7}';
    protected $description = 'Clean up held transactions older than specified days';

    public function handle()
    {
        try {
            $days = $this->option('days');
            $cutoffDate = Carbon::now()->subDays($days);

            $count = ModelHeldTransaction::where('created_at', '<', $cutoffDate)->delete();

            Log::info("Cleaned up held transactions", [
                'deleted_count' => $count,
                'older_than_days' => $days,
                'cutoff_date' => $cutoffDate
            ]);

            $this->info("Successfully deleted {$count} old held transactions");
        } catch (\Exception $e) {
            Log::error("Error cleaning up held transactions", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error("Failed to cleanup held transactions: {$e->getMessage()}");
        }
    }
}
