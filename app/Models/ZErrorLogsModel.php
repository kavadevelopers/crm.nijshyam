<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZErrorLogsModel extends Model
{
    use HasFactory;

    protected $table = '_error_logs';

    protected $fillable = [
        'type',
        'sub_type',
        'description',
        'notes'
    ];
}
