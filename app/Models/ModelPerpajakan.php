<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelPerpajakan extends Model
{
    use HasFactory;

    protected $table = 'perpajakan';
    protected $primaryKey = 'pajak_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'pajak'
    ];

    protected $casts = [
        'pajak' => 'decimal:2',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
}
