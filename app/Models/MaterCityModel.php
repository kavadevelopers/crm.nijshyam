<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterCityModel extends Model
{
    use HasFactory;

    protected $table = 'master_city';

    public function country(){
        return $this->belongsTo(MaterCountryModel::class, 'country_id');
    }

    public function state(){
        return $this->belongsTo(MaterStateModel::class, 'state_id');
    }

    protected $fillable = [
        'country_id',
        'state_id',
        'name',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'country_id',
        'state_id',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
