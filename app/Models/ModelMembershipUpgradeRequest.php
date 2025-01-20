<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMembershipUpgradeRequest extends Model
{
    protected $table = 'membership_upgrade_requests';
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'outlet_id',
        'current_membership_id',
        'requested_membership_id',
        'upgrade_fee',
        'status',
        'reason',
        'payment_proof',
        'payment_status',
        'processed_by'
    ];

    protected $dates = [
        'requested_at',
        'processed_at'
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Payment status constants
    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_VERIFIED = 'verified';

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id');
    }

    public function currentMembership()
    {
        return $this->belongsTo(ModelMembership::class, 'current_membership_id');
    }

    public function requestedMembership()
    {
        return $this->belongsTo(ModelMembership::class, 'requested_membership_id');
    }

    public function processor()
    {
        return $this->belongsTo(ModelUser::class, 'processed_by');
    }
}
