<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ModelTransaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'user_id',
        'outlet_id',
        'wholesale_customer_id',
        'total_amount',
        'paid_amount',
        'received_amount',
        'change_amount',
        'payment_method',
        'payment_status',
        'transaction_date',
        'status',
        'sale_type',
        'bank_id'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'total_amount' => 'integer',
        'paid_amount' => 'integer',
        'received_amount' => 'integer',
        'change_amount' => 'integer'
    ];

    // Payment method enum values
    const PAYMENT_CASH = 'tunai';
    const PAYMENT_MBANKING = 'mbanking';

    // Payment status enum values 
    const STATUS_PAID = 'lunas';
    const STATUS_CREDIT = 'bon';

    // Transaction status enum values
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PARTIAL = 'partial';
    const STATUS_CANCELLED = 'cancelled';

    // Sale type enum values
    const SALE_RETAIL = 'ecer';
    const SALE_WHOLESALE = 'grosir';

    // Relationships
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id')
            ->withDefault(['username' => '-']);
    }

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function wholesaleCustomer()
    {
        return $this->belongsTo(ModelWholesaleCustomer::class, 'wholesale_customer_id', 'wholesale_customer_id')
            ->withDefault(['customer_name' => '-']);
    }

    public function bank()
    {
        return $this->belongsTo(ModelBank::class, 'bank_id', 'bank_id');
    }

    public function items()
    {
        return $this->hasMany(ModelTransactionItem::class, 'transaction_id', 'transaction_id');
    }

    public function getTotalPaidAttribute()
    {
        return $this->paymentDetails()->sum('amount');
    }

    // Add debug logging to getData method
    public static function getDebugData()
    {
        $query = self::query();
        \Log::info('SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);
        return $query->get();
    }

    // Add this debug method
    public static function debug()
    {
        try {
            $query = self::query();
            $data = $query->get();
            
            \Log::info('ModelTransaction Debug:', [
                'query' => $query->toSql(),
                'bindings' => $query->getBindings(),
                'count' => $data->count(),
                'data' => $data->toArray()
            ]);

            return $data;
        } catch (\Exception $e) {
            \Log::error('ModelTransaction Debug Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    // Timestamps
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
