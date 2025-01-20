<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipUpgradeRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $outlet;
    public $requestedMembership;

    public function __construct($outlet, $requestedMembership)
    {
        $this->outlet = $outlet;
        $this->requestedMembership = $requestedMembership;
    }

    public function build()
    {
        return $this->markdown('emails.membership.upgrade-rejected')
                    ->subject('Permintaan Upgrade Membership Ditolak');
    }
}
