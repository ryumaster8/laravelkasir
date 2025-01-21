<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $held_transaction_id
 * @property int|null $operator_id
 * @property int $outlet_id
 * @property int|null $customer_id
 * @property numeric $total_amount
 * @property string|null $note
 * @property array<array-key, mixed> $items_json
 * @property string $sale_type
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelUser|null $creator
 * @property-read \App\Models\ModelWholesaleCustomer|null $customer
 * @property-read \App\Models\ModelOutlet $outlet
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereHeldTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereItemsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereSaleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeldTransaction whereUpdatedAt($value)
 */
	class HeldTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $request_id
 * @property int $outlet_id
 * @property int $current_membership_id
 * @property int $requested_membership_id
 * @property string $change_type
 * @property numeric $change_fee
 * @property numeric|null $monthly_fee
 * @property string $status
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon $requested_at
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property int|null $processed_by
 * @property string|null $payment_proof
 * @property string $payment_status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\ModelMembership $currentMembership
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelUser|null $processor
 * @property-read \App\Models\ModelMembership $requestedMembership
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereChangeFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereChangeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereCurrentMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereMonthlyFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest wherePaymentProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereRequestedMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipChangeRequest whereUpdatedAt($value)
 */
	class MembershipChangeRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $activity_log_id
 * @property int $activity_log_operator_id
 * @property int $activity_log_outlet_id
 * @property string $action
 * @property string|null $description
 * @property string $timestamp
 * @property-read \App\Models\ModelUser $operator
 * @property-read \App\Models\ModelOutlet $outlet
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereActivityLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereActivityLogOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereActivityLogOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelActivityLog whereTimestamp($value)
 */
	class ModelActivityLog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $bank_id
 * @property int $outlet_id
 * @property string|null $bank_name
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelTransaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelBank whereUpdatedAt($value)
 */
	class ModelBank extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $cash_register_id
 * @property int $outlet_id
 * @property int $user_id
 * @property string $opening_balance
 * @property string $closing_balance
 * @property string $total_received
 * @property string $total_paid_out
 * @property string $date
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereCashRegisterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereClosingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereOpeningBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereTotalPaidOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereTotalReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCashRegisters whereUserId($value)
 */
	class ModelCashRegisters extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $category_id
 * @property string|null $category_name
 * @property int|null $outlet_id
 * @property int|null $user_id
 * @property bool $is_default
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelDiscount> $discounts
 * @property-read int|null $discounts_count
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelCategories whereUserId($value)
 */
	class ModelCategories extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $discount_id
 * @property string $discount_name
 * @property string $type
 * @property string $value
 * @property string $applies_to
 * @property int|null $category_id
 * @property int|null $product_id
 * @property string $start_date
 * @property string $end_date
 * @property int $auto_apply
 * @property string $level
 * @property int|null $discount_outlet_id
 * @property int $discount_operator_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $is_active Status diskon, 1 untuk aktif, 0 untuk tidak aktif
 * @property string $tipe_kasir
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelCategories> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\ModelCategories|null $category
 * @property-read \App\Models\ModelProduct|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelProduct> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereAppliesTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereAutoApply($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereDiscountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereDiscountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereDiscountOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereDiscountOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereTipeKasir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelDiscount whereValue($value)
 */
	class ModelDiscount extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $held_transaction_id
 * @property int|null $operator_id
 * @property int $outlet_id
 * @property int|null $customer_id
 * @property string $total_amount
 * @property string|null $note
 * @property array<array-key, mixed> $items_json
 * @property string $sale_type
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelUser|null $operator
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereHeldTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereItemsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereSaleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelHeldTransaction whereUpdatedAt($value)
 */
	class ModelHeldTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $membership_id
 * @property string|null $membership_name
 * @property string $features
 * @property int $branch_limit
 * @property int $daily_transaction_limit
 * @property int $daily_product_addition_limit
 * @property int $user_limit
 * @property bool $service_feature
 * @property bool $wholesale_feature
 * @property bool $service_receipt_printing
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $product_location_feature
 * @property string|null $stock_audit_feature
 * @property bool $cashier_receipt_printing_feature
 * @property bool $discount_feature
 * @property bool $product_image_feature
 * @property bool $low_stock_reminder_feature
 * @property bool $stock_correction_feature
 * @property bool $chat_feature
 * @property bool $sales_report_feature
 * @property bool $transaction_report_feature
 * @property bool $shortcut_feature
 * @property bool $custom_shortcut_feature
 * @property bool $log_activity_feature
 * @property numeric $biaya_pendaftaran
 * @property bool $is_active
 * @property int|null $rank
 * @property numeric $biaya_bulanan
 * @property numeric $biaya_upgrade
 * @property numeric $biaya_downgrade
 * @property bool $customer_contact_feature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelOutlet> $outlets
 * @property-read int|null $outlets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereBiayaBulanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereBiayaDowngrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereBiayaPendaftaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereBiayaUpgrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereBranchLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereCashierReceiptPrintingFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereChatFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereCustomShortcutFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereCustomerContactFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereDailyProductAdditionLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereDailyTransactionLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereDiscountFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereLogActivityFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereLowStockReminderFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereMembershipName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereProductImageFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereProductLocationFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereSalesReportFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereServiceFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereServiceReceiptPrinting($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereShortcutFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereStockAuditFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereStockCorrectionFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereTransactionReportFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereUserLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembership whereWholesaleFeature($value)
 */
	class ModelMembership extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $membership_history_id
 * @property int $outlet_id
 * @property int $old_membership_id
 * @property int $new_membership_id
 * @property numeric|null $upgrade_fee
 * @property string $status
 * @property string|null $notes
 * @property int|null $processed_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelMembership $newMembership
 * @property-read \App\Models\ModelMembership $oldMembership
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelUser|null $processedByUser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereMembershipHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereNewMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereOldMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipHistory whereUpgradeFee($value)
 */
	class ModelMembershipHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\ModelMembership|null $currentMembership
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelUser|null $processor
 * @property-read \App\Models\ModelMembership|null $requestedMembership
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipUpgradeRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipUpgradeRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelMembershipUpgradeRequest query()
 */
	class ModelMembershipUpgradeRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $outlet_id
 * @property int|null $admin_user_id
 * @property string|null $outlet_name
 * @property string|null $email
 * @property string|null $address
 * @property string|null $contact_info
 * @property string|null $logo
 * @property string|null $registration_status
 * @property string|null $jenis_outlet
 * @property int|null $membership_id
 * @property int|null $requested_membership_id
 * @property int|null $default_category_id
 * @property int|null $outlet_group_id
 * @property string|null $status_upgrade
 * @property string $upgrade_fee
 * @property \Illuminate\Support\Carbon|null $registration_date
 * @property \Illuminate\Support\Carbon|null $activation_date
 * @property \Illuminate\Support\Carbon|null $next_due_date
 * @property string $registration_fee
 * @property string $monthly_fee
 * @property int|null $parent_outlet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_active
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $membership_started_at
 * @property \Illuminate\Support\Carbon|null $membership_expires_at
 * @property bool|null $auto_renewal
 * @property string|null $subscription_status
 * @property-read \App\Models\ModelUser|null $adminUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ModelOutlet> $branchOutlets
 * @property-read int|null $branch_outlets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelCategories> $categories
 * @property-read int|null $categories_count
 * @property-read mixed $branch_count
 * @property-read mixed $days_remaining
 * @property-read mixed $subscription_status_text
 * @property-read \App\Models\ModelMembership|null $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MembershipChangeRequest> $membershipChangeRequests
 * @property-read int|null $membership_change_requests_count
 * @property-read \App\Models\ModelOutletGroup|null $outletGroup
 * @property-read ModelOutlet|null $parentOutlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelProductSerials> $productSerials
 * @property-read int|null $product_serials_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelProduct> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\ModelMembership|null $requestedMembership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelSuppliers> $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelUserPermission> $userPermissions
 * @property-read int|null $user_permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereActivationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereAutoRenewal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereDefaultCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereJenisOutlet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereMembershipExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereMembershipStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereMonthlyFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereNextDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereOutletGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereOutletName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereParentOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereRegistrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereRegistrationFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereRequestedMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereStatusUpgrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereSubscriptionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutlet whereUpgradeFee($value)
 */
	class ModelOutlet extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $outlet_group_id
 * @property string|null $outlet_group_name
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelOutlet> $outlets
 * @property-read int|null $outlets_count
 * @property-read \App\Models\ModelUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereOutletGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereOutletGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelOutletGroup whereUserId($value)
 */
	class ModelOutletGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $payment_confirmation_id
 * @property int $user_id
 * @property int $payment_outlet_id
 * @property string $bank_name
 * @property string $method_transfer
 * @property string $account_name
 * @property string $account_number
 * @property string $bukti_transfer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $bukti_transfer_url
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereBuktiTransfer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereMethodTransfer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation wherePaymentConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation wherePaymentOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPaymentConfirmation whereUserId($value)
 */
	class ModelPaymentConfirmation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pajak_id
 * @property int $user_id
 * @property int $outlet_id
 * @property numeric $pajak
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan wherePajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan wherePajakId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelPerpajakan whereUserId($value)
 */
	class ModelPerpajakan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $product_id
 * @property int|null $outlet_id
 * @property int|null $category_id
 * @property int|null $supplier_id
 * @property string $product_name
 * @property string|null $brand
 * @property string|null $product_code
 * @property string|null $description
 * @property string $price_modal
 * @property string $price_grosir
 * @property string $price
 * @property string|null $unit
 * @property bool $has_serial_number
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelCategories|null $category
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelProductStock> $productStock
 * @property-read int|null $product_stock_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelProductSerials> $serials
 * @property-read int|null $serials_count
 * @property-read \App\Models\ModelSuppliers|null $supplier
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereHasSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct wherePriceGrosir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct wherePriceModal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProduct whereUserId($value)
 */
	class ModelProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $image_id
 * @property int $product_id
 * @property int|null $outlet_id
 * @property int|null $user_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelProduct $product
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductImages whereUserId($value)
 */
	class ModelProductImages extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $serial_id
 * @property int $product_id
 * @property int|null $outlet_id
 * @property int|null $user_id
 * @property string $serial_number
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelProduct $product
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereSerialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductSerials whereUserId($value)
 */
	class ModelProductSerials extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $product_stock_id
 * @property int $product_id
 * @property int $outlet_id
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelProduct $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereProductStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductStock whereUpdatedAt($value)
 */
	class ModelProductStock extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $transit_id
 * @property int $product_id
 * @property int|null $serial_id
 * @property int $from_outlet_id
 * @property int $to_outlet_id
 * @property int $user_id
 * @property int|null $quantity
 * @property string $status
 * @property int|null $operator_sender
 * @property int|null $operator_receiver
 * @property int $has_serial_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet $fromOutlet
 * @property-read \App\Models\ModelUser|null $operatorReceiver
 * @property-read \App\Models\ModelUser|null $operatorSender
 * @property-read \App\Models\ModelProduct $product
 * @property-read \App\Models\ModelProductSerials|null $serial
 * @property-read \App\Models\ModelOutlet $toOutlet
 * @property-read \App\Models\ModelUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereFromOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereHasSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereOperatorReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereOperatorSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereSerialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereToOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereTransitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelProductTransit whereUserId($value)
 */
	class ModelProductTransit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $rekening_id
 * @property string|null $email
 * @property string $bank_name
 * @property string $account_number
 * @property string $account_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $is_active
 * @property int $is_default
 * @property-read mixed $formatted_account
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner default()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereRekeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRekeningOwner whereUpdatedAt($value)
 */
	class ModelRekeningOwner extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $role_id
 * @property string $role_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelUserPermission> $userPermissions
 * @property-read int|null $user_permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelUser> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRoles whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelRoles whereRoleName($value)
 */
	class ModelRoles extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $service_id
 * @property int $service_operator_id
 * @property int $service_outlet_id
 * @property int|null $service_teknisi_id
 * @property string $customer_name
 * @property string $device_name
 * @property string $tipe_perangkat
 * @property string $serial_number
 * @property string $keluhan
 * @property string|null $kerusakan
 * @property string|null $sparepart
 * @property string $progress_status
 * @property string|null $status_servis
 * @property \Illuminate\Support\Carbon|null $completion_estimate
 * @property \Illuminate\Support\Carbon|null $service_completion_date
 * @property string|null $equipment_included
 * @property string|null $biaya
 * @property string|null $uang_muka
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $tanggal_masuk
 * @property \Illuminate\Support\Carbon|null $tanggal_ambil
 * @property string|null $faktur
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $description
 * @property string|null $operator_batal
 * @property \Illuminate\Support\Carbon|null $tanggal_batal
 * @property string|null $operator_pengambilan
 * @property string|null $metode_pembayaran
 * @property string|null $status_pembayaran
 * @property string|null $sisa_pembayaran
 * @property-read \App\Models\ModelUser $operator
 * @property-read \App\Models\ModelUser|null $operatorBatal
 * @property-read \App\Models\ModelUser|null $operatorPengambilan
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelTeknisi|null $teknisi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereCompletionEstimate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereDeviceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereEquipmentIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereFaktur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereKeluhan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereKerusakan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereOperatorBatal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereOperatorPengambilan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereProgressStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereServiceCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereServiceOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereServiceOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereServiceTeknisiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereSisaPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereSparepart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereStatusPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereStatusServis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereTanggalAmbil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereTanggalBatal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereTipePerangkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereUangMuka($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelService whereUpdatedAt($value)
 */
	class ModelService extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $supplier_id
 * @property int|null $outlet_id
 * @property int|null $user_id
 * @property string|null $supplier_name
 * @property string|null $contact_info
 * @property string|null $address
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property bool $is_default
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelSuppliers whereUserId($value)
 */
	class ModelSuppliers extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $teknisi_id
 * @property int $operator_id
 * @property int $teknisi_outlet_id
 * @property string $nama_teknisi
 * @property string|null $kontak
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\ModelUser $operator
 * @property-read \App\Models\ModelOutlet $outlet
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereKontak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereNamaTeknisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereTeknisiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereTeknisiOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTeknisi whereUpdatedAt($value)
 */
	class ModelTeknisi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $transaction_id
 * @property int|null $user_id
 * @property int|null $outlet_id
 * @property int|null $wholesale_customer_id
 * @property int|null $total_amount
 * @property int|null $paid_amount
 * @property int|null $received_amount
 * @property int|null $change_amount
 * @property string $payment_method
 * @property string $payment_status
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property string $status
 * @property string $sale_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $bank_id
 * @property string|null $note
 * @property-read \App\Models\ModelBank|null $bank
 * @property-read mixed $total_paid
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelTransactionItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelUser|null $user
 * @property-read \App\Models\ModelWholesaleCustomer|null $wholesaleCustomer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereChangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereReceivedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereSaleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransaction whereWholesaleCustomerId($value)
 */
	class ModelTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\ModelTransaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionDetail query()
 */
	class ModelTransactionDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $transaction_item_id
 * @property int $transaction_id
 * @property int $product_id
 * @property int|null $product_stocks_id
 * @property int|null $user_id
 * @property int|null $outlet_id
 * @property int $quantity
 * @property int $price
 * @property numeric $discount
 * @property string|null $discount_type
 * @property int $subtotal
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property string $transaction_items_status
 * @property int|null $serial_id
 * @property string|null $cancel_reason
 * @property \Illuminate\Support\Carbon|null $cancelled_at
 * @property int|null $cancelled_by
 * @property-read \App\Models\ModelUser|null $cancelledBy
 * @property-read mixed $formatted_price
 * @property-read mixed $formatted_subtotal
 * @property-read mixed $status
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelProduct $product
 * @property-read \App\Models\ModelProductSerials|null $productSerial
 * @property-read \App\Models\ModelProductStock|null $productStock
 * @property-read \App\Models\ModelTransaction $transaction
 * @property-read \App\Models\ModelUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereCancelledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereProductStocksId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereSerialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereTransactionItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereTransactionItemsStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelTransactionItem whereUserId($value)
 */
	class ModelTransactionItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property string $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string|null $phone_number
 * @property string|null $profile_photo
 * @property int $is_owner
 * @property \Illuminate\Support\Carbon|null $last_login
 * @property string $status
 * @property int $is_parent
 * @property int $is_verified
 * @property string|null $verification_token
 * @property int $is_deletable
 * @property string|null $password
 * @property int|null $role_id
 * @property int|null $outlet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelRoles|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelUserPermission> $userPermissions
 * @property-read int|null $user_permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereIsDeletable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereIsParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUser whereVerificationToken($value)
 */
	class ModelUser extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_permission_id
 * @property int $operator_id
 * @property int|null $outlet_id
 * @property int|null $role_id
 * @property int|null $can_add_supplier
 * @property int|null $can_edit_supplier
 * @property int|null $can_delete_supplier
 * @property int|null $can_edit_category
 * @property int|null $can_delete_category
 * @property int|null $can_add_category
 * @property int|null $can_edit_product
 * @property int|null $can_delete_product
 * @property int|null $can_add_product
 * @property int|null $can_add_user
 * @property int|null $can_edit_user
 * @property int|null $can_delete_user
 * @property int|null $can_add_product_location
 * @property int|null $can_edit_product_location
 * @property int|null $can_delete_product_location
 * @property int|null $can_see_cost_price
 * @property int|null $can_see_sale_price
 * @property int|null $can_see_supplier
 * @property int|null $can_see_category
 * @property int|null $can_see_operator
 * @property int|null $can_see_outlet
 * @property int|null $can_see_stock
 * @property int|null $can_see_brand
 * @property int|null $can_see_product_location
 * @property int|null $can_see_barcode
 * @property int|null $can_see_unit_barcode
 * @property int $can_see_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelUser $operator
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \App\Models\ModelRoles|null $role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanAddCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanAddProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanAddProductLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanAddSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanAddUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanDeleteCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanDeleteProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanDeleteProductLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanDeleteSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanDeleteUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanEditCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanEditProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanEditProductLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanEditSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanEditUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeOutlet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeProductLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCanSeeUnitBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelUserPermission whereUserPermissionId($value)
 */
	class ModelUserPermission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $wholesale_customer_id
 * @property string|null $customer_name
 * @property string $email
 * @property string|null $contact_info
 * @property string|null $address
 * @property int|null $customer_outlet_id
 * @property int|null $operator_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\ModelUser|null $operator
 * @property-read \App\Models\ModelOutlet|null $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelTransaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereCustomerOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModelWholesaleCustomer whereWholesaleCustomerId($value)
 */
	class ModelWholesaleCustomer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\ModelTransaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentDetail query()
 */
	class PaymentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $product_stock_id
 * @property int $product_id
 * @property int $outlet_id
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModelOutlet $outlet
 * @property-read \App\Models\ModelProduct $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock available()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock byProductAndOutlet($productId, $outletId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereProductStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductStock whereUpdatedAt($value)
 */
	class ProductStock extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $transaction_id
 * @property int|null $user_id
 * @property int|null $outlet_id
 * @property int|null $wholesale_customer_id
 * @property int|null $total_amount
 * @property int|null $paid_amount
 * @property int|null $received_amount
 * @property int|null $change_amount
 * @property string $payment_method
 * @property string $payment_status
 * @property string $transaction_date
 * @property string $status
 * @property string $sale_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $bank_id
 * @property string|null $note
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModelTransactionItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentDetail> $paymentDetails
 * @property-read int|null $payment_details_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereChangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereReceivedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereSaleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereWholesaleCustomerId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property string $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string|null $phone_number
 * @property string|null $profile_photo
 * @property int $is_owner
 * @property string|null $last_login
 * @property string $status
 * @property int $is_parent
 * @property int $is_verified
 * @property string|null $verification_token
 * @property int $is_deletable
 * @property string|null $password
 * @property int|null $role_id
 * @property int|null $outlet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsDeletable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereVerificationToken($value)
 */
	class User extends \Eloquent {}
}

