<?php
namespace App\Helpers;

use App\Enums\DocumentEnum;
use App\Models\ZErrorLogsModel;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AwsS3Helper{

    public static function upload($filePath,$file,$visibility = 'private',$base64 = false):bool{
        try {
            if($base64){
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$file));
                if(Storage::disk('s3')->put($filePath, $image,$visibility)){
                    $state = true;
                }else{
                    $state = false;
                }
            }else{
                if(Storage::disk('s3')->put($filePath, file_get_contents($file),$visibility)){
                    $state = true;
                }else{
                    $state = false;
                }
            }
        } catch (S3Exception $e) {
            $state = false;
            ZErrorLogsModel::create([
                'type'          => 'Aws S3',
                'sub_type'      => 'Upload',
                'description'   => $e->getMessage()
            ]);
        }
        return $state;
    }

    public static function delete($filePath) : bool{
        try {
            if(Storage::disk('s3')->delete($filePath)){
                $state = true;
            }else{
                $state = false;
            }
        } catch (S3Exception $e) {
            $state = false;
            ZErrorLogsModel::create([
                'type'          => 'Aws S3',
                'sub_type'      => 'Delete',
                'description'   => $e->getMessage()
            ]);
        }
        return $state;
    }

    public static function isFileExists($file) : bool{
        return Storage::has($file);
    }

    public static function tempUrl($filePath,$minuutes = 1) : string{
        return Storage::temporaryUrl($filePath,now()->addMinutes($minuutes));
    }

    public static function url($filePath) : string{
        return Storage::url($filePath);
    }
    
}