<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    // 🔴 PENTING
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
