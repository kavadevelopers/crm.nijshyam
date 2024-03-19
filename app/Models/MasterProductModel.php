<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProductModel extends Model
{
    use HasFactory;

    protected $table = 'master_products';
    
    protected $fillable = [
        'name',
        'order',
        'description',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'description',
        'order',
        'is_blocked',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
