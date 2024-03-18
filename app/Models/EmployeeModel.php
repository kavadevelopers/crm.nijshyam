<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = "employees";

    protected $fillable = [
        'startup_id',
        'name',
        'email',
        'mobile',
        'department',
        'position',
        'address',
        'gender',
        'date_of_birth',
        'date_of_join',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
