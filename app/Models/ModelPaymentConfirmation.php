<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelPaymentConfirmation extends Model
{
    use HasFactory;

    protected $table = 'payment_confirmations';
    protected $primaryKey = 'payment_confirmation_id';

    // Make timestamps public
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'payment_outlet_id',
        'bank_name',
        'method_transfer',
        'account_name',
        'account_number',
        'bukti_transfer',
        'created_at',
        'updated_at'
    ];

    // Add any custom casting if needed
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Define relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'payment_outlet_id', 'outlet_id');
    }

    // Accessor for bukti transfer url
    public function getBuktiTransferUrlAttribute()
    {
        return asset('storage/bukti_transfer/' . $this->bukti_transfer);
    }
}
