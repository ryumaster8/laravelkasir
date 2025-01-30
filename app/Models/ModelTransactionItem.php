<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTransactionItem extends Model
{
    protected $table = 'transaction_items';
    protected $primaryKey = 'transaction_item_id';
    public $timestamps = false; // Disable automatic timestamp handling

    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_stocks_id',
        'user_id',
        'outlet_id',
        'quantity',
        'price',
        'discount',
        'serial_id',
        'discount_type',
        'subtotal',
        'transaction_date',
        'transaction_items_status',
        'cancel_reason',
        'cancelled_at',
        'cancelled_by',
        'status'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'quantity' => 'integer',
        'price' => 'integer',
        'discount' => 'decimal:2',
        'subtotal' => 'integer',
        'cancelled_at' => 'datetime'
    ];

    public function transaction()
    {
        return $this->belongsTo(ModelTransaction::class, 'transaction_id', 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(ModelProduct::class, 'product_id', 'product_id')
            ->withDefault(['product_name' => 'Unknown', 'product_code' => 'N/A']);
    }

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    /**
     * Get the formatted status
     */
    public function getStatusAttribute()
    {
        return ucfirst($this->transaction_items_status ?? 'pending');
    }

    /**
     * Get the formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the formatted subtotal
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Get product stock relation
     */
    public function productStock()
    {
        return $this->belongsTo(ModelProductStock::class, 'product_stocks_id', 'product_stocks_id');
    }

    /**
     * Get the serial product if exists
     */
    public function productSerial()
    {
        return $this->belongsTo(ModelProductSerials::class, 'serial_id', 'serial_id');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(ModelUser::class, 'cancelled_by', 'user_id');
    }
}
