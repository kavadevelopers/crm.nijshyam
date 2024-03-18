<?php

namespace App\Http\Controllers;

use App\Helpers\NotifyEmailHelper;
use App\Models\NotifyEmailModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function test() : void {
        $email = NotifyEmailModel::find(1);
        NotifyEmailHelper::send($email);
    }
}
