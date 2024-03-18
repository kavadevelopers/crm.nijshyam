<?php

namespace App\Models;

use App\Helpers\FilePathHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSectorModel extends Model{
    use HasFactory;

    protected $appends = ['logo_path'];

    public function getLogoPathAttribute(){
        if ($this->relationLoaded('logo')) {
            if($this->logo){
                return FilePathHelper::master_sector($this->logo->filename);
            }
            return NULL;
        }
        if($this->logo()){
            return FilePathHelper::master_sector($this->logo()->value('filename'));
        }
        return NULL;
    }

    public function logo(){
        return $this->belongsTo(DocumentModel::class, 'logo_id');
    }

    protected $table = 'master_sector';

    protected $fillable = [
        'name',
        'logo_id',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'logo_id',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
