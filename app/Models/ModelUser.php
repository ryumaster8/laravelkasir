<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ModelOutlet;
use App\Models\ModelRoles;
use App\Models\ModelUserPermission;


class ModelUser extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Gunakan HasApiTokens

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true; // Menggunakan timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'profile_photo',
        'is_owner',
        'last_login',
        'status',
        'is_parent',
        'is_verified',
        'verification_token',
        'is_deletable',
        'password',
        'role_id',
        'outlet_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the outlet associated with the user.
     */
    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id');
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(ModelRoles::class, 'role_id');
    }
    /**
     * Get the user permissions associated with the user.
     */
    public function userPermissions()
    {
        return $this->hasMany(ModelUserPermission::class, 'user_id');
    }
}
