<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCashRegisters extends Model
{
    use HasFactory;

    protected $table = 'cash_registers';
    protected $primaryKey = 'cash_register_id';

    protected $fillable = [
        'outlet_id',
        'user_id',
        'initial_cash',
        'total_paid_in',
        'total_paid_out',
        'type',
        'description',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
}
