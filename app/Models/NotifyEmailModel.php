<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyEmailModel extends Model
{
    use HasFactory;

    protected $table = 'notify_email';
    
    protected $fillable = [
        'trycount',
        'status',
        'response_code',
        'response',
        'destination',
        'subject',
        'body',
        'attechments',
    ];
}
