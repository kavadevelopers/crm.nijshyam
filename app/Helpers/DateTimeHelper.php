<?php
namespace App\Helpers;

use Carbon\Carbon;

class DateTimeHelper{
    
    public static function otpExpired($min = false){
        if($min){
            return Carbon::parse(date('Y-m-d H:i:s'))->addMinutes($min)->format('Y-m-d H:i:s');
        }else{
            return Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(10)->format('Y-m-d H:i:s');
        }
    }

    public static function vcat($item){
        return Carbon::parse($item)->format('d M Y h:i A');
    }

    public static function vdate($item){
        if ($item != "" || $item != NULL) {
            return Carbon::parse($item)->format('d-m-Y');
        }else{
            return NULL;
        }
    }
}