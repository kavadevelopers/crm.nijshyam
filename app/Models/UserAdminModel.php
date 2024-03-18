<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdminModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_admin';

    protected $guard = 'admin';

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'role',
        'name',
        'username',
        'mobile',
        'email',
        'gender',
        'rights',
        'password',
        'ask_password_change',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
