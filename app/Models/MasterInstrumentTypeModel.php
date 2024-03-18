<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterInstrumentTypeModel extends Model
{
    use HasFactory;

    protected $table = 'master_instrument_type';

    protected $fillable = [
        'name',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
