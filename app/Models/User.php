<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];

    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
