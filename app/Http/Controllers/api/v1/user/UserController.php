<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use App\Models\LeadsModel;
use App\Models\UserAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{

    public function followup(Request $request) : Response {
        $leads = LeadsModel::orderby('follow_up_date','asc')->with('source','product','lastfollowup')->where('follow_up_date','!=',NULL);
        $total = $leads->count();
        if($request->skip){
            $leads->skip($request->skip);
        }
        if($request->take){
            $leads->take($request->take);
        }
        return CommonHelper::response('1',[
            'message'   => 'Home',
            'data'      => [
                'total'     => $total,
                'list'      => $leads->get()
            ],
            'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
        ]);
    }
    
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
    
    public function acDelete(Request $request){

        $user = UserAdminModel::find($request->user()->id);
        if($user){
            $user->is_deleted = '1';
            $user->save();
        }

        $request->user()->currentAccessToken()->delete();
        return CommonHelper::response(1,[
            'message' => 'Your Account is Deleted'
        ]);
    }
}
