<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelKasAwal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kas_awal';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kas_awal_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created_by',
        'outlet_id',
        'nominal',
        'date',
        'waktu',
        'keterangan'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nominal' => 'decimal:2',
        'date' => 'date',
        'waktu' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the user that created the kas awal.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }

    /**
     * Get the outlet associated with the kas awal.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
}
