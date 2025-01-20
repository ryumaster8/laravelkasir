<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRoles extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nama tabel di database
    protected $primaryKey = 'role_id'; // Nama primary key
    public $timestamps = false; // nonaktifkan penggunaan timestamps default

    // Define role constants
    const ROLE_OWNER = 'owner';
    const ROLE_SUPER_ADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * Get list of available roles
     */
    public static function getAvailableRoles(): array
    {
        return [
            self::ROLE_OWNER,
            self::ROLE_SUPER_ADMIN,
            self::ROLE_ADMIN,
            self::ROLE_USER
        ];
    }

    /**
     * Check if role name is valid
     */
    public static function isValidRole(string $role): bool
    {
        return in_array($role, self::getAvailableRoles());
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_name',
    ];

    /**
     * Get all of the users for the role.
     */
    public function users()
    {
        return $this->hasMany(ModelUser::class, 'role_id');
    }

    /**
     * Get all of the user permissions for the role.
     */
    public function userPermissions()
    {
        return $this->hasMany(ModelUserPermission::class, 'role_id');
    }
}
