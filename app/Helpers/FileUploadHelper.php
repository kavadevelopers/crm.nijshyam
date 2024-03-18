<?php
namespace App\Helpers;

use App\Enums\DocumentEnum;
use Illuminate\Support\Facades\Log;

class FileUploadHelper{

    public static function startup_logo($file) : mixed {
        $name = CommonHelper::generateFileName().'.'.$file->getClientOriginalExtension();
        $path = FilePathHelper::startup_logo($name);
        $isUploaded = AwsS3Helper::upload(
            $path,
            $file,
            'public'
        );
        if($isUploaded){ 
            return DocumentHelper::create($name,$file,DocumentEnum::STARTUPLOGO);
        }else{
            return NULL;
        }
    }

    public static function pitch_deck($file) : mixed {
        $name = CommonHelper::generateFileName().'.'.$file->getClientOriginalExtension();
        $path = FilePathHelper::pitch_deck($name);
        $isUploaded = AwsS3Helper::upload(
            $path,
            $file,
            'public'
        );
        if($isUploaded){ 
            return DocumentHelper::create($name,$file,DocumentEnum::PITCHDECK);
        }else{
            return NULL;
        }
    }

    public static function financial($file) : mixed {
        $name = CommonHelper::generateFileName().'.'.$file->getClientOriginalExtension();
        $path = FilePathHelper::financial($name);
        $isUploaded = AwsS3Helper::upload(
            $path,
            $file,
            'public'
        );
        if($isUploaded){ 
            return DocumentHelper::create($name,$file,DocumentEnum::FINANCIAL);
        }else{
            return false;
        }
    }

    public static function mis($file) : mixed {
        $name = CommonHelper::generateFileName().'.'.$file->getClientOriginalExtension();
        $path = FilePathHelper::mis($name);
        $isUploaded = AwsS3Helper::upload(
            $path,
            $file,
            'public'
        );
        if($isUploaded){ 
            return DocumentHelper::create($name,$file,DocumentEnum::MIS);
        }else{
            return NULL;
        }
    }


    // Master Uploads
    public static function master_sector($file) : mixed {
        $name = CommonHelper::generateFileName().'.'.$file->getClientOriginalExtension();
        $path = FilePathHelper::master_sector($name);
        $isUploaded = AwsS3Helper::upload(
            $path,
            $file,
            'public'
        );
        if($isUploaded){ 
            return DocumentHelper::create($name,$file,DocumentEnum::MASTER_SECTOR);
        }else{
            return NULL;
        }
    }
}