<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOutlet extends Model
{
    use HasFactory;

    protected $table = 'outlets';
    protected $primaryKey = 'outlet_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_user_id',
        'outlet_name',
        'email',
        'address',
        'contact_info', // Make sure this is correct
        'logo',
        'registration_status',
        'jenis_outlet',
        'membership_id',
        'requested_membership_id',
        'default_category_id',
        'outlet_group_id',
        'status_upgrade',
        'upgrade_fee',
        'registration_date',
        'activation_date',
        'next_due_date',
        'registration_fee',
        'monthly_fee',
        'parent_outlet_id',
        'is_active',
        'status',
        'membership_started_at',
        'membership_expires_at',
        'auto_renewal',
        'subscription_status'
    ];

    protected $dates = [
        'membership_started_at',
        'membership_expires_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'registration_date' => 'date',
        'activation_date' => 'date',
        'next_due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'auto_renewal' => 'boolean',
        'membership_started_at' => 'date',
        'membership_expires_at' => 'date'
    ];

    /**
     * Get the user that owns the outlet.
     */
    public function adminUser()
    {
        return $this->belongsTo(ModelUser::class, 'admin_user_id');
    }

    /**
     * Get the parent outlet.
     */
    public function parentOutlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'parent_outlet_id');
    }

    /**
     * Get the outlet group that owns the outlet.
     */
    public function outletGroup()
    {
        return $this->belongsTo(ModelOutletGroup::class, 'outlet_group_id', 'outlet_group_id');
    }

    /**
     * Get all of the products for the outlet.
     */
    public function products()
    {
        return $this->hasMany(ModelProduct::class, 'outlet_id');
    }

    /**
     * Get all of the categories for the outlet.
     */
    public function categories()
    {
        return $this->hasMany(ModelCategories::class, 'outlet_id');
    }
    /**
     * Get all of the user permission for the outlet.
     */
    public function userPermissions()
    {
        return $this->hasMany(ModelUserPermission::class, 'outlet_id');
    }
    /**
     * Get the supplier that owns the outlet.
     */
    public function suppliers()
    {
        return $this->hasMany(ModelSuppliers::class, 'outlet_id');
    }
    /**
     * Get the product serial that owns the outlet.
     */
    public function productSerials()
    {
        return $this->hasMany(ModelProductSerials::class, 'outlet_id');
    }
    /**
     * Get the membership associated with the outlet.
     */
    public function membership()
    {
        return $this->belongsTo(ModelMembership::class, 'membership_id', 'membership_id');
    }
    /**
     * Get the requested membership associated with the outlet.
     */
    public function requestedMembership()
    {
        return $this->belongsTo(ModelMembership::class, 'requested_membership_id');
    }

    /**
     * Get the branch outlets for this outlet.
     */
    public function branchOutlets()
    {
        return $this->hasMany(ModelOutlet::class, 'parent_outlet_id', 'outlet_id');
    }

    /**
     * Get the count of branch outlets
     */
    public function getBranchCountAttribute()
    {
        return $this->branchOutlets()->count();
    }

    /**
     * Update outlet membership
     */
    public function updateMembership($newMembershipId)
    {
        $this->membership_id = $newMembershipId;
        $this->save();
        
        return $this;
    }

    public function isSubscriptionActive()
    {
        if (!$this->membership_expires_at) {
            return false;
        }
        return now()->lt($this->membership_expires_at);
    }

    public function getDaysUntilExpiration()
    {
        if (!$this->membership_expires_at) {
            return 0;
        }
        return max(0, now()->diffInDays($this->membership_expires_at, false));
    }

    public function updateSubscriptionStatus()
    {
        $daysLeft = $this->getDaysUntilExpiration();
        
        if ($daysLeft <= 0) {
            $this->subscription_status = 'expired';
        } elseif ($daysLeft <= 7) {
            $this->subscription_status = 'expiring_soon';
        } else {
            $this->subscription_status = 'active';
        }
        
        $this->save();
        return $this;
    }

    public function extendSubscription($months = 1)
    {
        if (!$this->membership_expires_at) {
            $this->membership_started_at = now();
            $this->membership_expires_at = now()->addMonths($months);
        } else {
            // If still active, extend from current expiry date
            if ($this->isSubscriptionActive()) {
                $this->membership_expires_at = $this->membership_expires_at->addMonths($months);
            } else {
                // If expired, start fresh from now
                $this->membership_started_at = now();
                $this->membership_expires_at = now()->addMonths($months);
            }
        }

        $this->subscription_status = 'active';
        $this->save();
        return $this;
    }

    public function cancelAutoRenewal()
    {
        $this->auto_renewal = false;
        $this->save();
        return $this;
    }

    public function enableAutoRenewal()
    {
        $this->auto_renewal = true;
        $this->save();
        return $this;
    }

    // Add subscription status accessor
    public function getSubscriptionStatusTextAttribute()
    {
        switch ($this->subscription_status) {
            case 'active':
                return 'Aktif';
            case 'expiring_soon':
                return 'Akan Berakhir';
            case 'expired':
                return 'Berakhir';
            default:
                return 'Tidak Diketahui';
        }
    }

    // Add days remaining accessor
    public function getDaysRemainingAttribute()
    {
        return $this->getDaysUntilExpiration();
    }

    /**
     * Get all membership change requests for the outlet.
     */
    public function membershipChangeRequests()
    {
        return $this->hasMany(MembershipChangeRequest::class, 'outlet_id', 'outlet_id');
    }

    /**
     * Get all outlets from same group except current one
     */
    public function getSameGroupOutlets()
    {
        // Get current outlet's group ID
        $groupId = $this->outlet_group_id;
        
        // Get all outlets from same group except self, sorted by name
        return ModelOutlet::where('outlet_group_id', $groupId)
            ->where('outlet_id', '!=', $this->outlet_id)
            ->orderBy('outlet_name', 'asc')
            ->get();
    }
}
