<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockNotification extends Model
{
    protected $table = 'stock_notifications';
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'outlet_id',
        'product_id', 
        'status',
        'message',
        'is_read'
    ];

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function product()
    {
        return $this->belongsTo(ModelProduct::class, 'product_id', 'product_id');
    }
}
