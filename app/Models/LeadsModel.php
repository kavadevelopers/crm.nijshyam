<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsModel extends Model
{
    use HasFactory;

    public function source(){
        return $this->belongsTo(MasterSourceModel::class, 'source_id');
    }

    public function product(){
        return $this->belongsTo(MasterProductModel::class, 'product_id');
    }

    protected $table = 'leads';
    
    protected $fillable = [
        'priority',
        'source_id',
        'product_id',
        'lead_id',
        'name',
        'mobile',
        'email',
        'city',
        'address',
        'description',
        'follow_up_date',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
