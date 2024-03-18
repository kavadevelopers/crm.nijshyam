<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use App\Models\UserAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    //

    public function __construct(Request $rec){
		$this->middleware(function ($request, $next){
			if (!Auth::guard('admin')->check()) {
	   			return Redirect(CommonHelper::admin())->send();
			}
			return $next($request);
	  	});
	}


    public function save(Request $rec){
		$data = $rec->all();

		foreach ($data as $key => $value) {
			SettingModel::where('item',$key)->update(['value' => CommonHelper::isColValue($value)]);
	    }

	    Session::flash('success', 'Settings saved.');
	    return Redirect()->back();
	}

	public function index(){
		AdminHelper::redirectIfNotAuth([]);
		$data['_title'] = 'Settings';
		return view('admin.settings.index',$data);
	}


    public function profile(){
		$data['_title'] = 'My Profile';
		$data['item']	 = AdminHelper::getUser();
		return view('admin.settings.profile',$data);
	}

	public function profileSave(Request $rec){
		$data = [
			'name'			=> 	$rec->name,
			'username'		=> 	$rec->username,
			'email'			=> 	$rec->email,
			'mobile'		=> 	$rec->mobile
		];

		UserAdminModel::where('id',Auth::guard('admin')->user()->id)->update($data);

		if ($rec->password) {
			$data = [
				'password'		=> 	password_hash($rec->password, PASSWORD_DEFAULT),
			];
			UserAdminModel::where('id',Auth::guard('admin')->user()->id)->update($data);
		}

		Session::flash('success', 'Profile updated.');
		return Redirect()->back();
	}
}
