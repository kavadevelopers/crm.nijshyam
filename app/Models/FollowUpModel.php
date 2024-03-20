<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpModel extends Model{
    use HasFactory;

    protected $appends = ['followup_by','followup_at'];

    public function lead(){
        return $this->hasOne(FollowUpModel::class, 'lead_id');
    }

    public function userget(){
        return $this->belongsTo(UserAdminModel::class, 'created_by');
    }

    

    protected $table = 'followup';
    
    protected $fillable = [
        'lead_id',
        'description',
        'type',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'id',
        'lead_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function getFollowupAtAttribute(){
        return Carbon::parse($this->created_at)->format('d M Y H:i A');
    }

    public function getFollowupByAttribute(){
        if($this->userget()){
            return $this->userget()->value('name');
        }
        return NULL;
    }
}
