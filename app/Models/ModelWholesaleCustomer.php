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
        'customer_name',
        'email',
        'contact_info',
        'address',
        'customer_outlet_id',
        'operator_id',
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
}
