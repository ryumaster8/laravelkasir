<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMembershipHistory extends Model
{
    protected $table = 'membership_history';
    protected $primaryKey = 'membership_history_id';

    protected $fillable = [
        'outlet_id',
        'old_membership_id',
        'new_membership_id',
        'upgrade_fee',
        'status',
        'notes',
        'processed_by'
    ];

    protected $casts = [
        'upgrade_fee' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Define possible status values
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Relationships
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function oldMembership()
    {
        return $this->belongsTo(ModelMembership::class, 'old_membership_id', 'membership_id');
    }

    public function newMembership()
    {
        return $this->belongsTo(ModelMembership::class, 'new_membership_id', 'membership_id');
    }

    public function processedByUser()
    {
        return $this->belongsTo(ModelUser::class, 'processed_by', 'user_id');
    }
}
