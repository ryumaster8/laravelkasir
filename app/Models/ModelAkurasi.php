<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelAkurasi extends Model
{
    use HasFactory;

    protected $table = 'akurasi';
    protected $primaryKey = 'akurasi_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'created_by',
        'outlet_id',
        'date',
        'waktu',
        'kas_awal',
        'penjualan_ecer',
        'penarikan_kas',
        'penambahan_kas',
        'penjualan_grosir',
        'kas_akhir',
        'selisih',
        'keterangan'
    ];

    protected $casts = [
        'date' => 'date',
        'waktu' => 'datetime',
        'kas_awal' => 'decimal:2',
        'penjualan_ecer' => 'decimal:2',
        'penarikan_kas' => 'decimal:2',
        'penambahan_kas' => 'decimal:2',
        'penjualan_grosir' => 'decimal:2',
        'kas_akhir' => 'decimal:2',
        'selisih' => 'decimal:2'
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
