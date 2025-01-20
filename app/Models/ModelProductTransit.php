<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelProductTransit extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_transits';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'transit_id';

    /**
     * Indicates if the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

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
        'serial_id',
        'from_outlet_id',
        'to_outlet_id',
        'user_id',
        'quantity',
        'status',
        'operator_sender',
        'operator_receiver',
        'has_serial_number'
    ];

    /**
     * Get the product that owns the product transit.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ModelProduct::class, 'product_id', 'product_id');
    }

    /**
     * Get the serial number that owns the product transit.
     */
    public function serial(): BelongsTo
    {
        return $this->belongsTo(ModelProductSerials::class, 'serial_id', 'serial_id');
    }

    /**
     * Get the from outlet that owns the product transit.
     */
    public function fromOutlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'from_outlet_id', 'outlet_id');
    }

    /**
     * Get the to outlet that owns the product transit.
     */
    public function toOutlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'to_outlet_id', 'outlet_id');
    }

    /**
     * Get the user that owns the product transit.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
    /**
     * Get the operator sender that owns the product transit.
     */
    public function operatorSender(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'operator_sender', 'user_id');
    }
    /**
     * Get the operator receiver that owns the product transit.
     */
    public function operatorReceiver(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'operator_receiver', 'user_id');
    }
}
