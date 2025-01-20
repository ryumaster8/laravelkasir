<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModelOutlet;
use App\Models\MembershipChangeRequest;
use Carbon\Carbon;

class ProcessAutoRenewals extends Command
{
    protected $signature = 'memberships:process-renewals';
    protected $description = 'Process auto renewals for expiring memberships';

    public function handle()
    {
        // Get outlets with auto renewal enabled and expiring in 7 days
        $outlets = ModelOutlet::where('auto_renewal', true)
            ->whereDate('membership_expires_at', '<=', Carbon::now()->addDays(7))
            ->whereDate('membership_expires_at', '>', Carbon::now())
            ->get();

        foreach ($outlets as $outlet) {
            // Check if there's no pending renewal request
            $hasPendingRequest = MembershipChangeRequest::where('outlet_id', $outlet->outlet_id)
                ->where('status', 'pending')
                ->exists();

            if (!$hasPendingRequest) {
                // Create renewal request
                MembershipChangeRequest::create([
                    'outlet_id' => $outlet->outlet_id,
                    'current_membership_id' => $outlet->membership_id,
                    'requested_membership_id' => $outlet->membership_id, // Same membership
                    'change_type' => 'renewal',
                    'change_fee' => $outlet->membership->biaya_bulanan,
                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                    'requested_at' => now()
                ]);

                // Notify outlet
                $outlet->notify(new MembershipRenewalRequestNotification());
            }
        }
    }
}
