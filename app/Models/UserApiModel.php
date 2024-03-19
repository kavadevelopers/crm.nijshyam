<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserApiModel extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
    
    protected $guard = 'api-guard';

    protected $table = 'user_admin';

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

    protected $hidden = [
        'role',
        'password',
        'rights',
        'password',
        'ask_password_change',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
