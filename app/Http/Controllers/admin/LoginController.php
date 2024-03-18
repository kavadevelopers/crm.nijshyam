<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\UserAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //

    public function index() : View{
        return view('admin.login');
    }

    public function forget() : View{
        return view('admin.forget');
    }

    public function resetPassword(Request $rec) : Response{
        $user = UserAdminModel::where('id',$rec->id)->first(); 
        if ($user) {
            if ($user->otp == $rec->code) {
                UserAdminModel::where('id',$rec->id)->update(['password' => password_hash($rec->pass,PASSWORD_DEFAULT)]);
                return CommonHelper::retJson(['_return' => true,'msg' => "Password Changed."]);        
            }else{
                return CommonHelper::retJson(['_return' => false,'msg' => "Verification code is not valid"]);      
            }
        }else{
            return CommonHelper::retJson(['_return' => false,'msg' => "Error please try agin later"]); 
        }
    }

    public function forgetCheck(Request $rec) : Response{
        $user = UserAdminModel::where('email',$rec->email)->where('df','')->first();
        if ($user) {
            $otp = mt_rand(111111,999999);
            UserAdminModel::where('id',$user->id)->update(['otp' => $otp]);
            $msg = "Your verification code is :- ".$otp;
            // if(@PMalier::send($user->email,'Verification code',$msg)){
            //     return CommonHelper::retJson(['_return' => true,'msg' => "Verification code sent to your Email address",'user' => $user->id]); 
            // }else{
            //     return CommonHelper::retJson(['_return' => false,'msg' => "We can't send email right now. Please contact administrator"]);  
            // }
        }else{
            return CommonHelper::retJson(['_return' => false,'msg' => "We can't find account assigned with this email"]);  
        }
    }

    public function login(Request $rec) : Response{
        $user = UserAdminModel::where('username',$rec->user)->where('is_deleted','')->first();
        if($user){
            if (password_verify($rec->pass, $user->password)) {
                if(Auth::guard('admin')->attempt(['username' => $rec->user,'password' => $rec->pass])){
                    return CommonHelper::retJson(array(0,'Login Success...',''));  
                }else{
                    return CommonHelper::retJson(array(1,'Login Failed.',''));     
                }
            }else{
                return CommonHelper::retJson(array(1,'Password is not valid','')); 
            }
        }else{
            return CommonHelper::retJson(array(1,'Username Not Registered',''));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return Redirect(CommonHelper::admin(''));
    }

}
