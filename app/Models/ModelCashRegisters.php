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
        'opening_balance',
        'closing_balance',
        'total_received',
        'description',
        'total_paid_out',
        'date',
        'status',
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
