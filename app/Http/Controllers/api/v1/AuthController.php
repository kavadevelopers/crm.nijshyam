<?php

namespace App\Http\Controllers\api\v1;

use App\Enums\UserEnum;
use App\Enums\VerificationCodeTypeEnum;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\UserStartUpModel;
use App\Models\VerificationCodeModel;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller{

    public function resetPassword(Request $request) : Response {
        if(!$request->userid){
            return CommonHelper::response('0',['message' => '`userid` is reqiured.']);
        }else if(!$request->password){
            return CommonHelper::response('0',['message' => '`password` is reqiured.']);
        }else{
            $user = UserStartUpModel::where('id',$request->userid)->where('is_deleted','0')->first();
            if(!$user){
                return CommonHelper::response('0',['message' => 'User not found']);
            }else{
                $user->password = Hash::make($request->password);
                $user->save();

                return CommonHelper::response('1',[
                    'message' => 'Password changed',
                    'data'    => NULL
                ]);
            }
        }
    }

    public function forgotVerifyCode(Request $request) : Response {
        if(!$request->userid){
            return CommonHelper::response('0',['message' => '`userid` is reqiured.']);
        }else if(!$request->code){
            return CommonHelper::response('0',['message' => '`code` is reqiured.']);
        }else{
            $user = UserStartUpModel::where('id',$request->userid)->where('is_deleted','0')->first();
            if(!$user){
                return CommonHelper::response('0',['message' => 'User not found']);
            }else{
                $codeActive = VerificationCodeModel::where('code',$request->code)
                    ->where('user_id',$user->id)
                    ->where('user_type',UserEnum::STARTUP)
                    ->where('code_type',VerificationCodeTypeEnum::FORGOT_PASSWORD)->first();

                if (!$codeActive) {
                    return CommonHelper::response('0',['message' => 'Verification code does not exists.']);
                }else{
                    if($codeActive->is_used == '1'){
                        return CommonHelper::response('0',['message' => 'Verification code already used. Try Sending another code.']);
                    }else{
                        if(Carbon::now()->gt($codeActive->expired_at)){
                            return CommonHelper::response('0',['message' => 'Verification code expired. Try Sending another code.']);
                        }else{
                            $codeActive->is_used = '1';
                            $codeActive->save();

                            return CommonHelper::response('1',[
                                'message' => 'Verification code valid.',
                                'data'    => [
                                    'userid'    => $user->id
                                ]
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function forgotVerifyUser(Request $request) : Response {
        if(!$request->username){
            return CommonHelper::response('0',['message' => '`username` is reqiured. Pass mobile or emailid here']);
        }else{
            $user = UserStartUpModel::where(function ($query) use ($request) {
                $query->where('email',$request->username)
                  ->orWhere('mobile',$request->username);
            })->where('is_deleted','0')->first();
            if(!$user){
                return CommonHelper::response('0',['message' => '`username` not registered']);
            }else{
                if($user->is_blocked == '1'){
                    return CommonHelper::response('0',['message' => 'Your account is blocked please contact administrator.']);
                }else{
                    CommonHelper::sendVerificationCodeToSMS(
                        $user->id,
                        UserEnum::STARTUP,
                        VerificationCodeTypeEnum::FORGOT_PASSWORD,
                        $user->mobile
                    );
                    
                    return CommonHelper::response('1',[
                        'message' => 'Verification code sent',
                        'data'    => [
                            'userid'    => $user->id
                        ]
                    ]);
                }
            }
        }
    }
    
    public function login(Request $request) : Response {
        if(!$request->username){
            return CommonHelper::response('0',['message' => '`username` is reqiured. Pass mobile or emailid here']);
        }else if(!$request->password){
            return CommonHelper::response('0',['message' => '`password` is reqiured.']);
        }else{
            $user = UserStartUpModel::where(function ($query) use ($request) {
                    $query->where('email',$request->username)
                      ->orWhere('mobile',$request->username);
            })->where('is_deleted','0')->with('startup')->first();

            if(!$user){
                return CommonHelper::response('0',['message' => '`username` not registered']);
            }else{
                if($user->is_blocked == '1'){
                    return CommonHelper::response('0',['message' => 'Your account is blocked please contact administrator.']);
                }else{
                    $item = is_numeric($request->username)?'Mobile no.':'Email';
                    if(!Hash::check($request->password,$user->password)){
                        return CommonHelper::response('0',['message' => $item.' and Password not match.']);
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
