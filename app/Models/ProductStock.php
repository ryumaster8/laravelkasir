<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     *
     * @var string
     */
    protected $table = 'product_stock';

    /**
     * Primary key yang digunakan oleh tabel
     *
     * @var string
     */
    protected $primaryKey = 'product_stock_id';

    /**
     * Atribut yang dapat diisi secara massal
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'outlet_id',
        'stock',
    ];

    /**
     * Relasi ke model Product
     */
    public function product()
    {
        return $this->belongsTo(ModelProduct::class, 'product_id', 'product_id');
    }

    /**
     * Relasi ke model Outlet
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    /**
     * Scope untuk mencari stok berdasarkan product_id dan outlet_id
     */
    public function scopeByProductAndOutlet($query, $productId, $outletId)
    {
        return $query->where('product_id', $productId)
            ->where('outlet_id', $outletId);
    }

    /**
     * Scope untuk mendapatkan stok yang tersedia (lebih dari 0)
     */
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }
}
