<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeldTransaction extends Model
{
    protected $table = 'held_transactions';
    protected $primaryKey = 'held_transaction_id';
    
    protected $fillable = [
        'outlet_id',
        'customer_id',
        'total_amount',
        'note',
        'items_json',
        'created_by'
    ];

    protected $casts = [
        'items_json' => 'array',
        'total_amount' => 'decimal:2'
    ];

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function customer()
    {
        return $this->belongsTo(ModelWholesaleCustomer::class, 'customer_id', 'wholesale_customer_id');
    }

    public function creator()
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }
}
