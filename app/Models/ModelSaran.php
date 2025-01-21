<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelSaran extends Model
{
    // Define the table name
    protected $table = 'saran';

    // Define primary key
    protected $primaryKey = 'saran_id';

    // Define fillable fields
    protected $fillable = [
        'outlet_id',
        'created_by',
        'saran'
    ];

    // Define timestamps
    public $timestamps = true;

    // Relationship with Outlet model
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'created_by', 'user_id');
    }
}
