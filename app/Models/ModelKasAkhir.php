<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelKasAkhir extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kas_akhir';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'kas_akhir_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
     * @var array
     */
    protected $casts = [
        'nominal' => 'decimal:2',
        'date' => 'date',
        'waktu' => 'datetime'
    ];

    /**
     * Get the user that created the kas akhir.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }

    /**
     * Get the outlet that owns the kas akhir.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
}
