<?php

namespace App\Mail;

use App\Models\ModelOutlet;
use App\Models\ModelMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipUpgradeApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $outlet;
    public $oldMembership;
    public $newMembership;

    public function __construct(ModelOutlet $outlet, ModelMembership $oldMembership, ModelMembership $newMembership)
    {
        $this->outlet = $outlet;
        $this->oldMembership = $oldMembership;
        $this->newMembership = $newMembership;
    }

    public function build()
    {
        return $this->view('emails.membership.upgrade-approved')
                    ->subject('Permintaan Upgrade Membership Disetujui')
                    ->with([
                        'outlet' => $this->outlet,
                        'oldMembership' => $this->oldMembership,
                        'newMembership' => $this->newMembership
                    ]);
    }
}
