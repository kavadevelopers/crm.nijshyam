<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\UserAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{

    public function delete($id){
		$user = UserAdminModel::find($id);
        if($user){
            $user->is_deleted = '1';
            $user->save();
        }
		Session::flash('success', 'User Deleted'); 
		return Redirect(CommonHelper::admin('users'));	
	}

    public function status($id,$status = false){	
		$st = "0";
		$message = "Admin is now active";
		if ($status) {
			$st = "1";
			$message = "Admin is now blocked";
		}
        $user = UserAdminModel::find($id);
        if($user){
            $user->is_blocked = $st;
            $user->save();
        }
		

		Session::flash('success', $message); 
		return Redirect(CommonHelper::admin('users'));		
	}

    public function update(Request $rec){
		$rules = array(
	        'username' => 'alpha_dash'
	    );
		$validator = Validator::make($rec->all(), $rules);
		if ($validator->fails()) {
			Session::flash('error', 'Username must be character, numbers, underscore and dash.'); 
			return Redirect::back()->withInput($rec->all());
		}else{
			$user = UserAdminModel::where('username',$rec->username)->where('is_deleted','0')->where('id','!=',$rec->id)->first();
			if (!$user) {
                $user = UserAdminModel::where('id',$rec->id)->first();
                $user->name     = $rec->name;
                $user->username = $rec->username;

                if ($rec->password) {
                    $user->password = Hash::make($rec->password);
                }
                $user->save();

                Session::flash('success', 'User Updated'); 
                return Redirect(CommonHelper::admin('users'));	
			}else{
				Session::flash('error', 'Username already exists.'); 
				return Redirect::back()->withInput($rec->all());
			}
		}
	}
    
    public function save(Request $rec){
		$rules = array(
	        'username' => 'alpha_dash'
	    );
		$validator = Validator::make($rec->all(), $rules);
		if ($validator->fails()) {
			Session::flash('error', 'Username must be character, numbers, underscore and dash.'); 
			return Redirect::back()->withInput($rec->all());
		}else{
			$user = UserAdminModel::where('username',$rec->username)->where('is_deleted','0')->first();
			if (!$user) {
                UserAdminModel::create([
                    'role'		    => '1',
                    'name'			=> $rec->name,
                    'username'		=> $rec->username,
                    'password'		=> Hash::make($rec->password),
                    'gender'        => 'Male',
                    'mobile'		=> '0000000000',
                ]);

                Session::flash('success', 'User Created'); 
                return Redirect(CommonHelper::admin('users'));	        
			}else{
				Session::flash('error', 'Username already exists.'); 
				return Redirect::back()->withInput($rec->all());
			}
		}
	}

    public function edit($id){
		$data['_title'] = 'Edit User';
		$data['type'] 	= 'edit';
		$data['item']	= UserAdminModel::where('id',$id)->first();
		return view('admin.users',$data);		
	}

    public function create(){
		$data['_title'] = 'Create User';
		$data['type'] 	= 'create';
		return view('admin.users',$data);		
	}

    public function index(){
		$data['_title'] = 'Manage Users';
		$data['type'] 	= 'list';
		$data['list']	= UserAdminModel::where('is_deleted','0')->where('id','!=','1')->get();
		return view('admin.users',$data);	
	}
}
