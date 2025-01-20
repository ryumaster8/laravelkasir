<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelService extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'service_id';
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completion_estimate' => 'date',
        'service_completion_date' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_ambil' => 'date',
        'tanggal_batal' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    protected $fillable = [
        'service_operator_id',
        'service_outlet_id',
        'service_teknisi_id',
        'customer_name',
        'device_name',
        'tipe_perangkat',
        'serial_number',
        'keluhan',
        'kerusakan',
        'sparepart',
        'progress_status',
        'status_servis',
        'completion_estimate',
        'service_completion_date',
        'equipment_included',
        'biaya',
        'uang_muka',
        'tanggal_masuk',
        'tanggal_ambil',
        'faktur',
        'description',
        'operator_batal',
        'tanggal_batal',
        'operator_pengambilan',
        'metode_pembayaran',
        'status_pembayaran',
        'sisa_pembayaran',
    ];

    /**
     * Get the operator associated with the service.
     */
    public function operator()
    {
        return $this->belongsTo(ModelUser::class, 'service_operator_id');
    }
    /**
     * Get the outlet associated with the service.
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'service_outlet_id');
    }
    /**
     * Get the teknisi associated with the service.
     */
    public function teknisi()
    {
        return $this->belongsTo(ModelTeknisi::class, 'service_teknisi_id');
    }
    public function operatorPengambilan()
    {
        return $this->belongsTo(ModelUser::class, 'operator_pengambilan', 'user_id');
    }
    public function operatorBatal()
    {
        return $this->belongsTo(ModelUser::class, 'operator_batal');
    }
}
