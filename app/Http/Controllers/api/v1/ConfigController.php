<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{

    public function get(){

        $getconfig = [];
        $region = Config::get('filesystems.disks.s3.region');
        $bucket = Config::get('filesystems.disks.s3.bucket');
        $S3baseUrl = "https://s3-$region.amazonaws.com/$bucket/";
        
        $getconfig['document_max_size'] = CommonHelper::setting('file_document_max_size');
        $getconfig['document_extensions'] = CommonHelper::setting('file_document_extensions_allowed');
        $getconfig['image_max_size'] = CommonHelper::setting('file_image_max_size');
        $getconfig['image_extensions'] = CommonHelper::setting('file_image_extensions_allowed');
        $getconfig['s3-baseurl'] = $S3baseUrl;

        return CommonHelper::response('1',[
            'message' => 'Config Data',
            'data'    => $getconfig
        ]);
    }

}
