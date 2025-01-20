<?php

namespace App\Jobs;

use App\Models\ModelOutlet;
use App\Notifications\MembershipExpirationReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendMembershipExpirationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $outlet;

    public function __construct(ModelOutlet $outlet)
    {
        $this->outlet = $outlet;
    }

    public function handle()
    {
        $daysLeft = $this->outlet->getDaysUntilExpiration();
        
        if ($daysLeft <= 7 && $daysLeft > 0) {
            Notification::route('mail', $this->outlet->email)
                ->notify(new MembershipExpirationReminder($this->outlet, $daysLeft));
        }
    }
}
