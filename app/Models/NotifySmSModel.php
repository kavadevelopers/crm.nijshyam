<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifySmSModel extends Model
{
    use HasFactory;

    protected $table = 'notify_sms';
    
    protected $fillable = [
        'trycount',
        'status',
        'response_code',
        'response',
        'url',
        'params'
    ];
}
