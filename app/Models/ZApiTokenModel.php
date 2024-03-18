<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZApiTokenModel extends Model
{
    use HasFactory;

    protected $table = '_api_tokens';
    protected $fillable = [
        'token'
    ];
}
