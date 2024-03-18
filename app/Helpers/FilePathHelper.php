<?php
namespace App\Helpers;


class FilePathHelper{

    public static function mis($name = '') : string {
        return 'public/documents/startup/mis/'.$name;
    }

    public static function financial($name = '') : string {
        return 'public/documents/startup/financial/'.$name;
    }

    public static function pitch_deck($name = '') : string {
        return 'public/documents/startup/pitch_deck/'.$name;
    }

    public static function startup_logo($name = '') : string {
        return 'public/documents/startup/logo/'.$name;
    }

    public static function master_sector($name = '') : string {
        return 'public/documents/master/sectors/'.$name;
    }

}