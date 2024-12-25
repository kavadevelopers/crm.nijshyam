<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelModel extends Model
{
    use HasFactory;

    protected $table = 'master_label';

    protected $fillable = [
        'name',
        'is_deleted',
        'updated_by',
        'created_by'
    ];

    protected $hidden = [
        'is_deleted',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
}
