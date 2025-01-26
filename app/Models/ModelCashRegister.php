<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ModelProduct;
use App\Models\ModelOutlet;
use App\Models\ModelUser;

class ModelProductSerials extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_serials';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'serial_id';
    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';
    /**
     * Indicates if the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'serial_number',
        'status',
        'user_id',
        'outlet_id'
    ];

    /**
     * Status constants
     */
    const STATUS_TERSEDIA = 'tersedia';
    const STATUS_TERJUAL = 'terjual';
    const STATUS_DALAM_KERANJANG = 'dalam_keranjang';
    const STATUS_TRANSIT = 'transit';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_TERSEDIA  // Default status when creating new serial
    ];

    /**
     * Get the product that owns the category.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class, 'product_id', 'product_id');
    }
    /**
     * Get the outlet that owns the category.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    /**
     * Get the user that owns the category.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
}

class ModelCashRegister extends Model
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
        'total_paid_out',
        'date',
        'description',
        'status'
    ];

    protected $attributes = [
        'opening_balance' => 0.00,
        'closing_balance' => 0.00,
        'total_received' => 0.00,
        'total_paid_out' => 0.00,
        'status' => 'open'
    ];

    // ...existing relationships code...
}