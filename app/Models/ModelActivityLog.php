<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $primaryKey = 'activity_log_id';
    public $timestamps = false; // Nonaktifkan timestamps karena sudah ada field 'timestamp'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'activity_log_operator_id',
        'activity_log_outlet_id',
        'action',
        'description',
        'timestamp'
    ];

    /**
     * Create detailed activity log
     */
    public static function createLog($userId, $outletId, $action, $details)
    {
        $user = ModelUser::find($userId);
        $outlet = ModelOutlet::find($outletId);

        $description = sprintf(
            "[%s] Operator: %s (ID: %d) | Outlet: %s (ID: %d) | %s",
            strtoupper($action),
            $user ? $user->username : 'Unknown',
            $userId,
            $outlet ? $outlet->outlet_name : 'Unknown',
            $outletId,
            $details
        );

        return self::create([
            'activity_log_operator_id' => $userId,
            'activity_log_outlet_id' => $outletId,
            'action' => $action,
            'description' => $description,
            'timestamp' => now()
        ]);
    }

    /**
     * Format currency for logging
     */
    public static function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Get the user that owns the activity.
     */
    public function operator()
    {
        return $this->belongsTo(ModelUser::class, 'activity_log_operator_id');
    }
    /**
     * Get the outlet that owns the activity.
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'activity_log_outlet_id');
    }
}
