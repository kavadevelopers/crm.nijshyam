<?php

namespace App\Helpers;

use App\Models\GlobalSettings;
use App\Models\VerificationCodeModel;
use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class CommonHelper{
    

    public static function setting(?string $key) : string {
        return app(GlobalSettings::class)->get($key);
    }

    public static function response($return = 0,$items = null, $status = 200):Response{
        $data = ['status' => $return];

        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if ($items) {
            foreach ($items as $key => $item) {
                $data[$key] = $item;
            }
        }

        // return Response::json($data, $status, [], JSON_PRETTY_PRINT);
        return response()->json($data, $status)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

    //temporary
    public static function retJson($array):Response{
        return response()->json($array);
    }

    public static function generateFileName():string{
        return microtime(true).'-'.Str::random(60);
    }


    // fix settings
    public static function fileExtensionAllowedDocument($fixed = false) : array {
        if($fixed){
            return [$fixed];
        }
        return explode(',',self::setting('file_document_extensions_allowed'));
    }
    
    public static function maxFileSizeDocument($inMb = false) : int {
        if($inMb){
            return (int) self::setting('file_document_max_size');    
        }
        $size = (int) self::setting('file_document_max_size');
        return (int) ($size * 1024 * 1024);
    }

    public static function fileExtensionAllowedImage() : array {
        return explode(',',self::setting('file_image_extensions_allowed'));
    }
    
    public static function maxFileSizeImage($inMb = false) : int {
        if($inMb){
            return (int) self::setting('file_image_max_size');    
        }
        $size = (int) self::setting('file_image_max_size');
        return (int) ($size * 1024 * 1024);
    }

    public static function admin($link = false) : string{
        if ($link) {
            return url('admin/'.$link);
        }else{
            return url('admin/login');
        }
    }

    public static function generateOTP($length = 6) :string{
        if($length == '4'){
            return mt_rand(1111,9999);
        }else{
            return mt_rand(111111,999999);
        }
    }

    public static function isColValue($val) :string{
        if ($val && $val != NULL && $val != "") {
            return $val;
        }else{
            return "";
        }
    }

    public static function generateLeadId($val) :string{
        return "NIJ_0".$val;
    }
}

