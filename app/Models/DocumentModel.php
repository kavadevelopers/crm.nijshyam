<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    use HasFactory;

    protected $table = "documents";

    protected $fillable = [
        'type',
        'filename',
        'creator_type',
        'creator_id',
        'mime'
    ];

    protected $hidden = [
        'id',
        'type',
        'creator_type',
        'creator_id',
        'created_at',
        'updated_at',
    ];
}
