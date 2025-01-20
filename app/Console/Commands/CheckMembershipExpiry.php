<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModelOutlet;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipExpiryReminder;

class CheckMembershipExpiry extends Command
{
    protected $signature = 'membership:check-expiry';
    protected $description = 'Check and notify outlets about membership expiry';

    public function handle()
    {
        $nearExpiry = ModelOutlet::whereDate('next_due_date', '<=', now()->addDays(7))
            ->whereDate('next_due_date', '>', now())
            ->get();

        foreach($nearExpiry as $outlet) {
            // Kirim notifikasi email
            Mail::to($outlet->email)->send(new MembershipExpiryReminder($outlet));
        }
    }
}
