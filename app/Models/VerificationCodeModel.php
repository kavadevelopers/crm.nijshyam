<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCodeModel extends Model
{
    use HasFactory;

    protected $table = '_verification_codes';

    protected $fillable = [
        'user_id',
        'user_type',
        'code_type',
        'code',
        'is_used',
        'expired_at'
    ];
}
