<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelOutletGroup extends Model
{
    use HasFactory;

    protected $table = 'outlet_groups';

    protected $primaryKey = 'outlet_group_id';

    protected $fillable = [
        'outlet_group_name',
        'description',
        'user_id'
    ];

    public $timestamps = true;

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    // Relationship with Outlets
    public function outlets()
    {
        return $this->hasMany(ModelOutlet::class, 'outlet_group_id', 'outlet_group_id');
    }
}