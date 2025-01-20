<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTeknisi extends Model
{
    use HasFactory;

    protected $table = 'teknisi';
    protected $primaryKey = 'teknisi_id';
    public $timestamps = true;

    protected $fillable = [
        'operator_id',
        'teknisi_outlet_id',
        'nama_teknisi',
        'kontak',
        'status',
    ];

    /**
     * Get the operator associated with the teknisi.
     */
    public function operator()
    {
        return $this->belongsTo(ModelUser::class, 'operator_id');
    }
    /**
     * Get the outlet associated with the teknisi.
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'teknisi_outlet_id');
    }
}
