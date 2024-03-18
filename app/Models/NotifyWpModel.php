<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyWpModel extends Model
{
    use HasFactory;

    protected $table = 'notify_wp';

    protected $fillable = [
        'type',
        'trycount',
        'status',
        'response_code',
        'response',
        'data',
        'campaignname',
        'destination',
        'username',
        'media',
        'params'
    ];
}
