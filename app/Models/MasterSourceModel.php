<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSourceModel extends Model
{
    use HasFactory;

    protected $table = 'master_source';
    
    protected $fillable = [
        'name',
        'order',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'order',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
