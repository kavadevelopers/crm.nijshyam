<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\LeadsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function __construct(Request $rec)
	{
		$this->middleware(function ($request, $next) {
			if (!Auth::guard('admin')->check()) {
				return Redirect(CommonHelper::admin())->send();
			}
			return $next($request);
		});
	}

	public function index(): View
	{
		$data['_title'] = 'Dashboard';
		return view('admin.dashboard', $data);
	}

	public function active(): View
	{
		$data['_title'] = 'Active';
		$data['leads'] = LeadsModel::orderby('id', 'asc')->with('source', 'product', 'lastfollowup')->where('status', 'Active')->get();
		return view('admin.leads', $data);
	}

	public function customer(): View
	{
		$data['_title'] = 'Customer';
		$data['leads'] = LeadsModel::orderby('id', 'asc')->with('source', 'product', 'lastfollowup')->where('status', 'Customer')->get();
		return view('admin.leads', $data);
	}

	public function deleted(): View
	{
		$data['_title'] = 'Deleted';
		$data['leads'] = LeadsModel::orderby('id', 'asc')->with('source', 'product', 'lastfollowup')->where('status', 'Deleted')->get();
		return view('admin.leads', $data);
	}
}
