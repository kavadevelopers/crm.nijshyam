<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\MasterInstrumentTypeModel;
use App\Models\MasterInvestorTypeModel;
use App\Models\MasterProductModel;
use App\Models\MasterSectorModel;
use App\Models\MasterSourceModel;
use App\Models\MaterCityModel;
use App\Models\MaterCountryModel;
use App\Models\MaterStateModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MasterController extends Controller{   

    //Source
    public function sourceDelete($id): RedirectResponse{
        $source = MasterSourceModel::find($id);
        if($source){
            $source->is_deleted  = '1';
            $source->updated_by  =  Auth::guard('admin')->user()->id;
            $source->save();

            Session::flash('success', 'Product Deleted');
            return Redirect(CommonHelper::admin('master/source'));
        }else{
            Session::flash('success', 'Can not find Product');
            return Redirect(CommonHelper::admin('master/source'));
        }
    }

    public function sourceUpdate(Request $request) : RedirectResponse{
        $source = MasterSourceModel::find($request->item);
        if($source){
            $source->name  = Str::upper($request->name);
            if($request->order){
                $source->order  = $request->order;
            }else{
                $source->order  = 0;
            }
            $source->updated_by  =  Auth::guard('admin')->user()->id;
            $source->save();

            Session::flash('success', 'Product Updated');
            return Redirect(CommonHelper::admin('master/source'));
        }else{
            Session::flash('success', 'Can not find Product');
            return Redirect(CommonHelper::admin('master/source'));
        }
    }

    public function sourceEdit($id) : View{
        $data['_title'] = 'Edit Source';
        $data['type'] = 'edit';
        $data['item'] = MasterSourceModel::where('id',$id)->first();
        $data['list']   = MasterSourceModel::where('is_deleted','0')->orderby('order','asc')->get();
        return view('admin.master.source',$data);
    }

    public function sourceSave(Request $request) : RedirectResponse{ 
        $source = new MasterSourceModel;
        $source->name  = Str::upper($request->name);
        if($request->order){
            $source->order  = $request->order;
        }
        $source->created_by  =  Auth::guard('admin')->user()->id;
        $source->updated_by  =  Auth::guard('admin')->user()->id;
        $source->save();

        Session::flash('success', 'Product Created');
        return Redirect::back();
    }

    public function source() : View{
        $data['_title'] = 'Source';
        $data['type']   = 'list';
        $data['list']   = MasterSourceModel::where('is_deleted','0')->orderby('order','asc')->get();
        return view('admin.master.source',$data);
    }


    //product
    public function productsDelete($id): RedirectResponse{
        $product = MasterProductModel::find($id);
        if($product){
            $product->is_deleted  = '1';
            $product->updated_by  =  Auth::guard('admin')->user()->id;
            $product->save();

            Session::flash('success', 'Product Deleted');
            return Redirect(CommonHelper::admin('master/products'));
        }else{
            Session::flash('success', 'Can not find Product');
            return Redirect(CommonHelper::admin('master/products'));
        }
    }

    public function productsUpdate(Request $request) : RedirectResponse{
        $product = MasterProductModel::find($request->item);
        if($product){
            $product->name  = Str::upper($request->name);
            if($request->order){
                $product->order  = $request->order;
            }else{
                $product->order  = 0;
            }
            $product->updated_by  =  Auth::guard('admin')->user()->id;
            $product->save();

            Session::flash('success', 'Product Updated');
            return Redirect(CommonHelper::admin('master/products'));
        }else{
            Session::flash('success', 'Can not find Product');
            return Redirect(CommonHelper::admin('master/products'));
        }
    }

    public function productsEdit($id) : View{
        $data['_title'] = 'Edit Product';
        $data['type'] = 'edit';
        $data['item'] = MasterProductModel::where('id',$id)->first();
        $data['list']   = MasterProductModel::where('is_deleted','0')->orderby('order','asc')->get();
        return view('admin.master.products',$data);
    }

    public function productsSave(Request $request) : RedirectResponse{ 
        $product = new MasterProductModel;
        $product->name  = Str::upper($request->name);
        if($request->order){
            $product->order  = $request->order;
        }
        $product->created_by  =  Auth::guard('admin')->user()->id;
        $product->updated_by  =  Auth::guard('admin')->user()->id;
        $product->save();

        Session::flash('success', 'Product Created');
        return Redirect::back();
    }

    public function products() : View{
        $data['_title'] = 'Products';
        $data['type']   = 'list';
        $data['list']   = MasterProductModel::where('is_deleted','0')->orderby('order','asc')->get();
        return view('admin.master.products',$data);
    }

}
