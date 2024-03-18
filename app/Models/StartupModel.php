<?php

namespace App\Models;

use App\Helpers\FilePathHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupModel extends Model{
    use HasFactory;

    protected $with = ['sector'];
    protected $appends = ['pitch_deck_path','logo_path'];

    public function getPitchDeckPathAttribute(){
        if ($this->relationLoaded('pitch_deck')) {
            if($this->pitch_deck){
                return FilePathHelper::pitch_deck($this->pitch_deck->filename);
            }
            return NULL;
        }
        if($this->pitch_deck()){
            return FilePathHelper::pitch_deck($this->pitch_deck()->value('filename'));
        }
        return NULL;
    }
    
    public function getLogoPathAttribute(){
        if ($this->relationLoaded('logo')) {
            if($this->logo){
                return FilePathHelper::startup_logo($this->logo->filename);
            }
            return NULL;
        }
        if($this->logo()){
            return FilePathHelper::startup_logo($this->logo()->value('filename'));
        }
        return NULL;
    }

    public function pitch_deck(){
        return $this->belongsTo(DocumentModel::class, 'pitch_deck_id');
    }

    public function logo(){
        return $this->belongsTo(DocumentModel::class, 'logo_id');
    }

    public function sector(){
        return $this->belongsTo(MasterSectorModel::class, 'sector_id');
    }

    protected $table = 'startup';

    protected $fillable = [
        'brand_name',
        'legal_name',
        'sector_id',
        'short_description',
        'city',
        'state',
        'country',
        'address',
        'pincode',
        'logo',
        'cin',
        'date_of_incorporation',
        'status',
        'is_deleted',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'id',
        'sector_id',
        'pitch_deck_id',
        'logo_id',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
