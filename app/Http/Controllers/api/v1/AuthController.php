<?php

namespace App\Http\Controllers\api\v1;

use App\Enums\UserEnum;
use App\Enums\VerificationCodeTypeEnum;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\UserAdminModel;
use App\Models\UserApiModel;
use App\Models\UserStartUpModel;
use App\Models\VerificationCodeModel;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller{
    
    public function login(Request $request) : Response {
        if(!$request->username){
            return CommonHelper::response('0',['message' => '`username` is reqiured.']);
        }else if(!$request->password){
            return CommonHelper::response('0',['message' => '`password` is reqiured.']);
        }else{
            $user = UserApiModel::where('username',$request->username)->where('is_deleted','0')->where('role','1')->first();
            if(!$user){
                return CommonHelper::response('0',['message' => '`username` not registered']);
            }else{
                if($user->is_blocked == '1'){
                    return CommonHelper::response('0',['message' => 'Your account is blocked please contact administrator.']);
                }else{
                    if(!Hash::check($request->password,$user->password)){
                        return CommonHelper::response('0',['message' => 'Username and Password not match.']);
                    }else{
                        $user->token = $user->createToken("Personal Access Token")->plainTextToken;
                        return CommonHelper::response('1',[
                            'message' => 'Login Success',
                            'data'    => $user
                        ]);
                    }
                }
            }
        }
    }
}
