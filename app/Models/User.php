<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasRolesAndPermissions;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname', 'gender', 'img', 'role', 'phone', 'email', 'password', 'is_active'
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
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',

    ];


    // ...

    // User.php model or a helper class
    public function hasRole($role)
   {
        return $this->role === $role;
    }

//     public function hasRole(...$roles)
// {
//     return in_array($this->role, $roles);
// }



    public function superadmin()
    {
        return $this->hasOne(SuperAdmin::class, 'code_user');
    }

    public function directeur()
    {
        return $this->hasOne(Directeur::class, 'code_user');
    }

    public function surveillant()
    {
        return $this->hasOne(Surveillant::class, 'code_user');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'code_user');
    }


    public function tuteur()
    {
        return $this->hasOne(Tuteur::class, 'code_user');
    }

    public function caissier ()
    {
        return $this->hasOne(Caissier::class, 'code_user');
    }

    public function prof ()
    {
        return $this->hasOne(Prof::class, 'code_user');
    }


    // ...


}
