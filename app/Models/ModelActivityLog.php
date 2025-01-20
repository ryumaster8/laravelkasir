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
