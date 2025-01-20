<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelBank extends Model
{
    protected $table = 'banks';
    protected $primaryKey = 'bank_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'bank_name',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Status enum values as constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function transactions()
    {
        return $this->hasMany(ModelTransaction::class, 'bank_id', 'bank_id');
    }
}
