<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMembership extends Model
{
    use HasFactory;

    protected $table = 'memberships';
    protected $primaryKey = 'membership_id';
    
    protected $fillable = [
        'membership_name',
        'features',
        'branch_limit',
        'daily_transaction_limit',
        'daily_product_addition_limit',
        'user_limit',
        'service_feature',
        'wholesale_feature',
        'service_receipt_printing',
        'product_location_feature',
        'stock_audit_feature',
        'cashier_receipt_printing_feature',
        'discount_feature',
        'product_image_feature',
        'low_stock_reminder_feature',
        'stock_correction_feature',
        'chat_feature',
        'sales_report_feature',
        'transaction_report_feature',
        'shortcut_feature',
        'custom_shortcut_feature',
        'log_activity_feature',
        'biaya_pendaftaran',
        'is_active',
        'rank',
        'biaya_bulanan',
        'biaya_upgrade',
        'biaya_downgrade',
        'customer_contact_feature',
    ];

    protected $casts = [
        'service_feature' => 'boolean',
        'wholesale_feature' => 'boolean',
        'service_receipt_printing' => 'boolean',
        'cashier_receipt_printing_feature' => 'boolean',
        'discount_feature' => 'boolean',
        'product_image_feature' => 'boolean',
        'low_stock_reminder_feature' => 'boolean',
        'stock_correction_feature' => 'boolean',
        'chat_feature' => 'boolean',
        'sales_report_feature' => 'boolean',
        'transaction_report_feature' => 'boolean',
        'shortcut_feature' => 'boolean',
        'custom_shortcut_feature' => 'boolean',
        'log_activity_feature' => 'boolean',
        'customer_contact_feature' => 'boolean',
        'is_active' => 'boolean',
        'biaya_pendaftaran' => 'decimal:2',
        'biaya_bulanan' => 'decimal:2',
        'biaya_upgrade' => 'decimal:2',
        'biaya_downgrade' => 'decimal:2',
    ];

    public function outlets()
    {
        return $this->hasMany(ModelOutlet::class, 'membership_id', 'membership_id');
    }

    public function upgradeRequests()
    {
        return $this->hasMany(MembershipUpgradeRequest::class, 'requested_membership_id', 'membership_id');
    }

    public function currentMembershipRequests()
    {
        return $this->hasMany(MembershipUpgradeRequest::class, 'current_membership_id', 'membership_id');
    }

    /**
     * Check if membership allows branch creation
     */
    public function canCreateBranch()
    {
        return $this->branch_limit > 0;
    }

    /**
     * Check if outlet has reached branch limit
     */
    public function hasReachedBranchLimit($currentBranchCount)
    {
        if (!$this->canCreateBranch()) {
            return true;
        }
        return $currentBranchCount >= $this->branch_limit;
    }

    /**
     * Get remaining branch slots
     */
    public function getRemainingBranchSlots($currentBranchCount)
    {
        if (!$this->canCreateBranch()) {
            return 0;
        }
        return max(0, $this->branch_limit - $currentBranchCount);
    }

    /**
     * Get branch limit validation message
     */
    public function getBranchLimitMessage($currentBranchCount)
    {
        if (!$this->canCreateBranch()) {
            return 'Paket membership Anda tidak memiliki fitur penambahan cabang. Silakan upgrade membership Anda untuk menambah cabang.';
        }

        if ($this->hasReachedBranchLimit($currentBranchCount)) {
            return sprintf(
                'Anda telah mencapai batas maksimal cabang (%d dari %d). Silakan upgrade membership Anda untuk menambah cabang.',
                $currentBranchCount,
                $this->branch_limit
            );
        }

        return null;
    }

    // Add this scope after other methods
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
