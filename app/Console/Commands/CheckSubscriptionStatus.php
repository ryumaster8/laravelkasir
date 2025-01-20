<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModelOutlet;

class CheckSubscriptionStatus extends Command
{
    protected $signature = 'subscription:check-status';
    protected $description = 'Check and update subscription status for all outlets';

    public function handle()
    {
        $outlets = ModelOutlet::whereNotNull('membership_expires_at')->get();
        
        foreach ($outlets as $outlet) {
            $outlet->updateSubscriptionStatus();
            
            // If auto renewal is enabled and subscription is expiring soon
            if ($outlet->auto_renewal && $outlet->subscription_status === 'expiring_soon') {
                // TODO: Implement auto renewal logic
                $this->info("Auto renewal needed for outlet: {$outlet->outlet_name}");
            }
        }
        
        $this->info('Subscription status check completed');
    }
}
