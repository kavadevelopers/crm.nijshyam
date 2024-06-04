<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsModel extends Model
{
    use HasFactory;

    public function source()
    {
        return $this->belongsTo(MasterSourceModel::class, 'source_id');
    }

    public function product()
    {
        return $this->belongsTo(MasterProductModel::class, 'product_id');
    }

    public function lastfollowup()
    {
        return $this->hasOne(FollowUpModel::class, 'lead_id')->latest();
    }

    public function followups()
    {
        return $this->hasMany(FollowUpModel::class, 'lead_id')->latest();
    }

    protected $appends = ['entry_date', 'last_updated'];
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

    public function userget()
    {
        return $this->belongsTo(UserAdminModel::class, 'updated_by');
    }

    public function getLastUpdatedAttribute()
    {
        if ($this->userget()) {
            return $this->userget()->value('name');
        }
        return NULL;
    }


    public function getEntryDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i A');
    }
}
