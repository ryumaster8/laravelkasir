<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'outlet_id',
        'customer_id', 
        'total_amount',
        'paid_amount',
        'change_amount',
        'status',
        'payment_status',
        'payment_method',
        'reference_number'
    ];

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'transaction_id');
    }

    public function items()
    {
        return $this->hasMany(ModelTransactionItem::class, 'transaction_id');
    }
}
