<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $primaryKey = 'activity_log_id';
    public $timestamps = false;
    const CREATED_AT = 'timestamp'; // Map created_at to timestamp column

    protected $fillable = [
        'activity_log_operator_id',
        'activity_log_outlet_id',
        'action',
        'description',
        'timestamp'
    ];

    public static function createLog($userId, $outletId, $action, $details)
    {
        $user = ModelUser::find($userId);
        $outlet = ModelOutlet::find($outletId);

        $description = sprintf(
            "Operator: %s (ID: %d) | Outlet: %s (ID: %d) | %s",
            $user ? $user->username : 'Unknown',
            $userId,
            $outlet ? $outlet->outlet_name : 'Unknown',
            $outletId,
            $details
        );

        return self::create([
            'activity_log_operator_id' => $userId,
            'activity_log_outlet_id' => $outletId,
            'action' => strtoupper($action),
            'description' => $description,
            'timestamp' => now()
        ]);
    }

    /**
     * Get badge class for different actions
     */
    public static function getBadgeClass($action)
    {
        $classes = [
            'CREATE_BRANCH' => 'bg-green-100 text-green-800',
            'UPDATE_BRANCH' => 'bg-blue-100 text-blue-800',
            'DELETE_BRANCH' => 'bg-red-100 text-red-800',
            'TRANSFER_STOCK' => 'bg-blue-100 text-blue-800',
            'REDUCE_STOCK' => 'bg-red-100 text-red-800',
            'ADD_STOCK' => 'bg-green-100 text-green-800',
            'UPDATE_USER' => 'bg-yellow-100 text-yellow-800', // Add this line
        ];

        return $classes[$action] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Format currency for logging
     */
    public static function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Get the operator (user) that performed the activity.
     */
    public function operator()
    {
        return $this->belongsTo(ModelUser::class, 'activity_log_operator_id', 'user_id');
    }

    /**
     * Get the user that owns the activity.
     * @deprecated Use operator() instead
     */
    public function user()
    {
        return $this->operator();
    }

    /**
     * Get the outlet where the activity occurred.
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'activity_log_outlet_id', 'outlet_id');
    }
}
