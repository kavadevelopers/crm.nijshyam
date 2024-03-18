<?php
namespace App\Helpers;

use App\Enums\UserEnum;
use App\Models\DocumentModel;
use Illuminate\Support\Facades\Auth;

class DocumentHelper{

    public static function delete(DocumentModel $document) : void {
        if($document){
            $method = $document->type;
            $filePath = FilePathHelper::$method($document->filename);
            if(AwsS3Helper::isFileExists($filePath)){
                AwsS3Helper::delete($filePath);
            }
            $document->delete();
        }
    }

    public static function create($name,$file,$type) : string {
        $document = new DocumentModel;
        $document->type     = $type;
        $document->filename = $name;
        if(Auth::guard('api-guard')->check()){
            $document->creator_type = UserEnum::STARTUP;
            $document->creator_id = Auth::guard('api-guard')->user()->id;
        }
        $document->mime = $file->getMimeType();
        $document->save();
        return $document->id;
    }
}