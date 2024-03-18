<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AdminHelper{

    public static function getUser(){
        return Auth::guard('admin')->user();
    }

    public static function menu($seg,$array,$parent = false){
        $ret = array("","","");
        $path = Request::segment($seg);
        if(!$parent){
            foreach($array as $a){
                if($path === $a){
                    $ret = array("active kava-active","active kava-active","pcoded-trigger kava-active");
                    break;
                }
            }
        }else{
            foreach($array as $a){
                if($parent == Request::segment($seg - 1) && $path === $a){
                    $ret = array("active kava-active","active kava-active","pcoded-trigger kava-active");
                }
            }
        }

        return $ret;
    }

    public static function hasPermission($rights) : bool{
        $user = Auth::guard('admin')->user();
        if($user->id != '1'){
            $counter = 0;
            foreach (explode(',',$user->rights) as $key => $value) {
	            if(in_array($value, $rights)){
	                $counter++;
	            }
	        }

            if($counter > 0){
	            return true;
	        }else{
	            return false;
	        }
        }else{
            return true;
        }
    }

    public static function redirectIfNotAuth($rights){
        if(count($rights) > 0){
            if(self::hasPermission($rights)){
                return true;
            }else{
                return Redirect(CommonHelper::admin('dashboard'))->send();
            }
        }else{
            if(Auth::guard('admin')->user()->id == '1'){
                return true;
            }else{
                return Redirect(CommonHelper::admin('dashboard'))->send();
            }
        }
    }




}
