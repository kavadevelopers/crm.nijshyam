<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(Request $rec){
		$this->middleware(function ($request, $next){
			if (!Auth::guard('admin')->check()) {
	   			return Redirect(CommonHelper::admin())->send();
			}
			return $next($request);
	  	});
	}

	public function index() : View {
		$data['_title'] = 'Dashboard';
		return view('admin.dashboard',$data);	
	}
}
