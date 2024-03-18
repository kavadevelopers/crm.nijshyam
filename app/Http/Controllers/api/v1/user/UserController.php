<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{
    
    public function getUser() : Response {
        $user = Auth::guard('api-guard')->user();
        return CommonHelper::response(1,[
            'message' => 'Profile Get',
            'data'    => $user
        ]);
    }

    public function logout(Request $request) : Response {
        $request->user()->currentAccessToken()->delete();
        return CommonHelper::response(1,[
            'message' => 'Logout Done'
        ]);
    }    

    
}
