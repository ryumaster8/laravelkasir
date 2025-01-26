<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelKasAdjustment extends Model
{
    use HasFactory;

    protected $table = 'kas_adjustments';
    protected $primaryKey = 'kas_adjustment_id';
    protected $fillable = [
        'created_by',
        'outlet_id',
        'date',
        'waktu',
        'selisih',
        'keterangan'
    ];

    protected $casts = [
        'selisih' => 'decimal:2',
        'date' => 'date',
        'waktu' => 'datetime'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
}
