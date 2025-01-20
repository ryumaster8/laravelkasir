<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUserPermission extends Model
{
    use HasFactory;

    protected $table = 'user_permissions'; // Nama tabel
    protected $primaryKey = 'user_permission_id'; // Primary key tabel
    protected $fillable = [
        'operator_id', // Ganti user_id menjadi operator_id
        'outlet_id',
        'role_id',
        'can_add_supplier',
        'can_edit_supplier',
        'can_delete_supplier',
        'can_edit_category',
        'can_delete_category',
        'can_add_category',
        'can_edit_product',
        'can_delete_product',
        'can_add_product',
        'can_add_user',
        'can_edit_user',
        'can_delete_user',
        'can_add_product_location',
        'can_edit_product_location',
        'can_delete_product_location',
        'can_see_cost_price',
        'can_see_sale_price',
        'can_see_supplier',
        'can_see_category',
        'can_see_operator',
        'can_see_outlet',
        'can_see_stock',
        'can_see_brand',
        'can_see_product_location',
        'can_see_barcode',
        'can_see_unit_barcode',
        'can_see_product_id',
    ];
    public function operator() //ubah dari user ke operator
    {
        return $this->belongsTo(ModelUser::class, 'operator_id', 'user_id'); //ubah user_id menjadi operator_id dan tetap referensi ke kolom user_id
    }
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }
    public function role() //Tambahkan method untuk relasi role
    {
        return $this->belongsTo(ModelRoles::class, 'role_id', 'role_id');
    }
}
