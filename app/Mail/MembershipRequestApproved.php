<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MembershipChangeRequest;

class MembershipRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $membershipRequest;
    public $isOwner;

    public function __construct(MembershipChangeRequest $membershipRequest, bool $isOwner = false)
    {
        $this->membershipRequest = $membershipRequest;
        $this->isOwner = $isOwner;
    }

    public function build()
    {
        $view = $this->isOwner ? 'emails.membership-request-approved-owner' : 'emails.membership-request-approved';
        
        return $this->view($view)
            ->subject($this->isOwner ? 'Notifikasi Persetujuan Membership' : 'Persetujuan Perubahan Membership')
            ->with([
                'outletName' => $this->membershipRequest->outlet->outlet_name,
                'newMembership' => $this->membershipRequest->requestedMembership->membership_name,
                'changeFee' => number_format($this->membershipRequest->change_fee, 0, ',', '.'),
                'membershipRequest' => $this->membershipRequest, // Full object for template access
            ]);
    }
}
