<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $primaryKey = 'payment_detail_id';
    
    protected $fillable = [
        'transaction_id',
        'payment_method',
        'amount',
        'reference_number',
        'bank_name',
        'card_number',
        'approval_code',
        'ewallet_provider'
    ];

    public function transaction()
    {
        return $this->belongsTo(ModelTransaction::class, 'transaction_id', 'transaction_id');
    }
}
