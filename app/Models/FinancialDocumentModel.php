<?php

namespace App\Models;

use App\Helpers\FilePathHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDocumentModel extends Model
{
    use HasFactory;
    protected $appends = ['document_path'];
    
    public function document(){
        return $this->belongsTo(DocumentModel::class, 'document_id');
    }

    public function getDocumentPathAttribute(){
        if ($this->relationLoaded('document')) {
            if($this->document){
                return FilePathHelper::financial($this->document->filename);
            }
            return NULL;
        }
        if($this->document()){
            return FilePathHelper::financial($this->document()->value('filename'));
        }
        return NULL;
    }

    protected $table = 'startup_financial';

    protected $fillable = [
        'startup_id',
        'document_id',
        'description',
        'status',
        'is_deleted'
    ];

    protected $hidden = [
        'document_id',
        'is_deleted'
    ];
}
