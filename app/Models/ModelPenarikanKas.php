<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPenarikanKas extends Model
{
    protected $table = 'penarikan_kas';
    protected $primaryKey = 'penarikan_kas_id';

    protected $fillable = [
        'created_by',
        'outlet_id',
        'nominal',
        'date',
        'waktu',
        'keterangan'
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'date' => 'date',
        'waktu' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
}
