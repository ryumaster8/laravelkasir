<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipChangeRequest extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'membership_change_requests';
    protected $primaryKey = 'request_id';
    
    protected $fillable = [
        'outlet_id',
        'current_membership_id',
        'requested_membership_id',
        'change_type',
        'change_fee',
        'monthly_fee', // Added new field
        'payment_status',
        'payment_proof',
        'reason',
        'requested_at',
        'processed_at',
        'processed_by',
        'status'
    ];

    protected $dates = [
        'requested_at',
        'processed_at'
    ];

    protected $casts = [
        'change_type' => 'string',
        'change_fee' => 'decimal:2',
        'monthly_fee' => 'decimal:2', // Added new field
        'change_status' => 'string',
        'payment_status' => 'string',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime'
    ];

    // Relationships
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function currentMembership(): BelongsTo
    {
        return $this->belongsTo(ModelMembership::class, 'current_membership_id', 'membership_id');
    }

    public function requestedMembership(): BelongsTo
    {
        return $this->belongsTo(ModelMembership::class, 'requested_membership_id', 'membership_id');
    }

    public function processor()
    {
        return $this->belongsTo(ModelUser::class, 'processed_by', 'user_id')
            ->select(['user_id', 'username']); // Only select needed fields
    }

    // Helper methods
    public function isUpgrade()
    {
        return $this->change_type === 'upgrade';
    }

    public function isDowngrade()
    {
        return $this->change_type === 'downgrade';
    }

    // ...existing relationships...
}
