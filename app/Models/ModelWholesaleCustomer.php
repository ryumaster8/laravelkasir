<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelWholesaleCustomer extends Model
{
    use HasFactory;

    protected $table = 'wholesale_customers';
    protected $primaryKey = 'wholesale_customer_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'customer_name',  // This should match your database column name
        'email',
        'contact_info',
        'address',
        'customer_outlet_id',
        'operator_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke tabel Outlets
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'customer_outlet_id', 'outlet_id');
    }

    // Relasi ke tabel Users
    public function operator()
    {
        return $this->belongsTo(ModelUser::class, 'operator_id', 'user_id');
    }

    /**
     * Get the transactions for this wholesale customer.
     */
    public function transactions()
    {
        return $this->hasMany(ModelTransaction::class, 'wholesale_customer_id', 'wholesale_customer_id');
    }
}
