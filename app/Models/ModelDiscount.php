<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
