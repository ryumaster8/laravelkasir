<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'detail_id';
    
    protected $fillable = [
        'transaction_id',
        'key',
        'value'
    ];

    public function transaction()
    {
        return $this->belongsTo(ModelTransaction::class, 'transaction_id', 'transaction_id');
    }
}
