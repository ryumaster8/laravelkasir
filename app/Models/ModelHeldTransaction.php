<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelHeldTransaction extends Model
{
    protected $table = 'held_transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'outlet_id',
        'operator_id',
        'sale_type',
        'customer_id',
        'items_json', // Add this field
        'total_amount',
        'note'
    ];

    protected $casts = [
        'items_json' => 'array' // Add this to automatically handle JSON serialization
    ];

    // Add relationship to user/operator
    public function operator(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'operator_id', 'user_id');
    }
}
