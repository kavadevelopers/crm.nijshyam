<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserStartUpModel extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
    
    protected $guard = 'api-guard';

    protected $table = 'user_startup';

    public function startup(){
        return $this->belongsTo(StartupModel::class, 'startup_id');
    }


    protected $hidden = [
        'id',
        'ask_password_change',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by',
        'password'
    ];

    protected $fillable = [
        'startup_id',
        'name',
        'mobile',
        'email',
        'ask_password_change',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by',
        'password'
    ];
}
