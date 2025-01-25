<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany
use App\Models\ModelOutlet;
use App\Models\ModelCategories;
use App\Models\ModelSuppliers;
use App\Models\ModelUser;
use App\Models\ModelProductSerials; // Add missing import
use App\Models\ModelProductStock; // Add missing import
use Illuminate\Support\Facades\Log; // Add missing import


class ModelProduct extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_serial_number' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outlet_id',
        'category_id',
        'supplier_id',
        'product_name',
        'product_code',
        'description',
        'price_modal',
        'price_grosir',
        'brand',
        'price',
        // 'stock',
        'unit',
        'has_serial_number',
        // 'image',
        'user_id'
    ];
    /**
     * Get the outlet that owns the category.
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ModelCategories::class, 'category_id', 'category_id');
    }

    /**
     * Get the supplier that owns the product.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(ModelSuppliers::class, 'supplier_id', 'supplier_id');
    }

    /**
     * Get the user that owns the product.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    /**
     * Get all serials number for the product.
     */
    public function serials(): HasMany
    {
        Log::debug('Product serials relation called', [
            'product_id' => $this->product_id
        ]);
        return $this->hasMany(ModelProductSerials::class, 'product_id', 'product_id');
    }

    /**
     * Get the product stock records for the product.
     */
    public function productStock(): HasMany
    {
        return $this->hasMany(ModelProductStock::class, 'product_id', 'product_id');
    }
}
