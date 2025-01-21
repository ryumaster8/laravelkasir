<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModelDiscount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';

    protected $fillable = [
        'discount_name',
        'type',
        'value',
        'applies_to',
        'category_id',
        'product_id',
        'start_date',
        'end_date',
        'auto_apply',
        'level',
        'discount_outlet_id',
        'discount_operator_id',
        'is_active',
        'tipe_kasir',
    ];

    public function product()
    {
        return $this->belongsTo(ModelProduct::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ModelCategories::class, 'category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(ModelProduct::class, 'discount_products', 'discount_id', 'product_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ModelCategories::class, 'discount_categories', 'discount_id', 'category_id');
    }
}
