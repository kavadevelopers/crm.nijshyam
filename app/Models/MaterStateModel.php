<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterStateModel extends Model
{
    use HasFactory;
    protected $table = 'master_state';

    public function country(){
        return $this->belongsTo(MaterCountryModel::class, 'country_id');
    }

    protected $fillable = [
        'country_id',
        'name',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'country_id',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
