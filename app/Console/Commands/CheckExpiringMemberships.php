<?php

namespace App\Console\Commands;

use App\Models\ModelOutlet;
use App\Jobs\SendMembershipExpirationReminder;
use Illuminate\Console\Command;

class CheckExpiringMemberships extends Command
{
    protected $signature = 'membership:check-expiring';
    protected $description = 'Check for memberships that will expire soon and send reminders';

    public function handle()
    {
        $outlets = ModelOutlet::where('membership_expires_at', '>', now())
            ->where('membership_expires_at', '<=', now()->addDays(7))
            ->where('subscription_status', 'active')
            ->get();

        foreach ($outlets as $outlet) {
            SendMembershipExpirationReminder::dispatch($outlet);
        }

        $this->info("Found {$outlets->count()} outlets with expiring memberships");
    }
}
