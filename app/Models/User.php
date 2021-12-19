<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role_id',
        'nik_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'password',
        'image',
        'role_id',
        'nik_id',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $roleName)
    {
        return $this->role->auth == $roleName;
    }

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class, 'nik_id', 'nik');
    }

    public function hasDetail()
    {
        return $this->userDetail !== null ? ($this->userDetail->nik == auth()->user()->nik_id) : false;
    }

    public function requested()
    {
        return EktpRegister::firstWhere('user_id', auth()->id());
    }
}
