<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRekeningOwner extends Model
{
    use HasFactory;

    protected $table = 'rekening_owner';
    protected $primaryKey = 'rekening_id';

    protected $fillable = [
        'email',
        'bank_name',
        'account_number',
        'account_name',
        'is_active',
        'is_default'
    ];

    public $timestamps = true;

    // Scope to get active bank accounts
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope to get default bank account
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    // Helper method to get active account for payment
    public static function getActiveAccount()
    {
        return self::active()->default()->first() ?? self::active()->first();
    }

    // Format account info for display
    public function getFormattedAccountAttribute()
    {
        return "{$this->bank_name} - {$this->account_number} a.n {$this->account_name}";
    }
}
