<?php

namespace App\Http\Controllers\admin;

use App\Helpers\CommonHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\MasterInstrumentTypeModel;
use App\Models\MasterInvestorTypeModel;
use App\Models\MasterSectorModel;
use App\Models\MaterCityModel;
use App\Models\MaterCountryModel;
use App\Models\MaterStateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MasterController extends Controller
{   

    //city

    public function cityDelete($id){
        MaterCityModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'City Deleted');
        return Redirect(CommonHelper::admin('master/city'));
    }

    public function cityUpdate(Request $request){

        $city = MaterCityModel::find($request->item);
        if($city){
            $state = MaterStateModel::where('id',$request->state)->first();
            $city->name  = ucfirst($request->name);
            $city->country_id  = $state->country_id;
            $city->state_id  =  $request->state;
            $city->updated_by  =  Auth::guard('admin')->user()->id;
            $city->save();

            Session::flash('success', 'City Updated');
            return Redirect(CommonHelper::admin('master/city'));
        }else{
            Session::flash('success', 'Can not find City');
            return Redirect(CommonHelper::admin('master/city'));
        }
    }

    public function cityEdit($id){
        $data['_title'] = 'Edit City';
        $data['type'] = 'edit';
        $data['item'] = MaterCityModel::where('id',$id)->first();
        $data['list'] = MaterCityModel::where('is_deleted','0')->with('country','state')->get();
        $data['state']   = MaterStateModel::where('is_deleted','0')->get();
        return view('admin.master.city',$data);
    }

    public function citySave(Request $request){

        $state = MaterStateModel::where('id',$request->state)->first();
        $city = new MaterCityModel;
        $city->name  = ucfirst($request->name);
        $city->country_id  = $state->country_id;
        $city->state_id  = $request->state;
        $city->created_by  =  Auth::guard('admin')->user()->id;
        $city->updated_by  =  Auth::guard('admin')->user()->id;
        $city->save();

        Session::flash('success', 'City Created');
        return Redirect::back();
    }

    public function city() : View{
        $data['_title'] = 'City';
        $data['type']   = 'list';
        $data['list']   =  MaterCityModel::where('is_deleted','0')->get();
        $data['contry']   = MaterCountryModel::where('is_deleted','0')->get();
        $data['state']   = MaterStateModel::where('is_deleted','0')->get();
        return view('admin.master.city',$data);
    }




    // state

    public function stateDelete($id){
        MaterStateModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'State Deleted');
        return Redirect(CommonHelper::admin('master/state'));
    }

    public function stateUpdate(Request $request){
        $state = MaterStateModel::find($request->item);
        if($state){
            $state->name  = ucfirst($request->name);
            $state->country_id  = $request->country;
            $state->updated_by  =  Auth::guard('admin')->user()->id;
            $state->save();

            Session::flash('success', 'State Updated');
            return Redirect(CommonHelper::admin('master/state'));
        }else{
            Session::flash('success', 'Can not find State');
            return Redirect(CommonHelper::admin('master/state'));
        }
    }

    public function stateEdit($id){
        $data['_title'] = 'Edit State';
        $data['type'] = 'edit';
        $data['item'] = MaterStateModel::where('id',$id)->first();
        $data['list'] = MaterStateModel::where('is_deleted','0')->with('country')->get();
        $data['contry']  = MaterCountryModel::where('is_deleted','0')->get();
        return view('admin.master.state',$data);
    }

    public function stateSave(Request $request){
        $state = new MaterStateModel;
        $state->name  = ucfirst($request->name);
        $state->country_id  = $request->country;
        $state->created_by  =  Auth::guard('admin')->user()->id;
        $state->updated_by  =  Auth::guard('admin')->user()->id;
        $state->save();

        Session::flash('success', 'State Created');
        return Redirect::back();
    }

    public function state() : View{
        $data['_title'] = 'State';
        $data['type']   = 'list';
        $data['list']   = MaterStateModel::where('is_deleted','0')->with('country')->get();
        $data['contry']   = MaterCountryModel::where('is_deleted','0')->get();
        return view('admin.master.state',$data);
    }


    //country
    
    public function countryDelete($id){
        MaterCountryModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'Country Deleted');
        return Redirect(CommonHelper::admin('master/country'));
    }

    public function countryUpdate(Request $request){
        $country = MaterCountryModel::find($request->item);
        if($country){
            $country->name  = ucfirst($request->name);
            $country->updated_by  =  Auth::guard('admin')->user()->id;
            $country->save();

            Session::flash('success', 'Country Updated');
            return Redirect(CommonHelper::admin('master/country'));
        }else{
            Session::flash('success', 'Can not find Country');
            return Redirect(CommonHelper::admin('master/country'));
        }
    }

    public function countryEdit($id){
        $data['_title'] = 'Edit Country';
        $data['type'] = 'edit';
        $data['item'] = MaterCountryModel::where('id',$id)->first();
        $data['list']   = MaterCountryModel::where('is_deleted','0')->get();
        return view('admin.master.country',$data);
    }

    public function countrySave(Request $request){
        $country = new MaterCountryModel;
        $country->name  = ucfirst($request->name);
        $country->created_by  =  Auth::guard('admin')->user()->id;
        $country->updated_by  =  Auth::guard('admin')->user()->id;
        $country->save();

        Session::flash('success', 'Country Created');
        return Redirect::back();
    }

    public function country() : View{
        $data['_title'] = 'Country';
        $data['type']   = 'list';
        $data['list']   = MaterCountryModel::where('is_deleted','0')->get();
        return view('admin.master.country',$data);
    }


    //investor type

    public function investorTypeDelete($id){
        MasterInvestorTypeModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'Investor Type Deleted');
        return Redirect(CommonHelper::admin('master/investortype'));
    }

    public function investorTypeUpdate(Request $request){
        $investor = MasterInvestorTypeModel::find($request->item);
        if($investor){
            $investor->name  = ucfirst($request->name);
            $investor->updated_by  =  Auth::guard('admin')->user()->id;
            $investor->save();

            Session::flash('success', 'Investor Type Updated');
            return Redirect(CommonHelper::admin('master/investortype'));
        }else{
            Session::flash('success', 'Can not find Investor Type');
            return Redirect(CommonHelper::admin('master/investortype'));
        }
    }

    public function investorTypeEdit($id){
        $data['_title'] = 'Edit Investor Type';
        $data['type'] = 'edit';
        $data['item'] = MasterInvestorTypeModel::where('id',$id)->first();
        $data['list']   = MasterInvestorTypeModel::where('is_deleted','0')->get();
        return view('admin.master.investor-type',$data);
    }

    public function investorTypeSave(Request $request){
        $investor = new MasterInvestorTypeModel;
        $investor->name  = ucfirst($request->name);
        $investor->created_by  =  Auth::guard('admin')->user()->id;
        $investor->updated_by  =  Auth::guard('admin')->user()->id;
        $investor->save();

        Session::flash('success', 'Investor Type Created');
        return Redirect::back();
    }

    public function investorType() : View{
        $data['_title'] = 'Investor Type';
        $data['type']   = 'list';
        $data['list']   = MasterInvestorTypeModel::where('is_deleted','0')->get();
        return view('admin.master.investor-type',$data);
    }

    
    //instument type
    public function instrumentTypeDelete($id){
        MasterInstrumentTypeModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'Instrument Type Deleted');
        return Redirect(CommonHelper::admin('master/instrument-type'));
    }

    public function instrumentTypeUpdate(Request $request){
        $instrument = MasterInstrumentTypeModel::find($request->item);
        if($instrument){
            $instrument->name  = ucfirst($request->name);
            $instrument->updated_by  =  Auth::guard('admin')->user()->id;
            $instrument->save();

            Session::flash('success', 'Instrument Type Updated');
            return Redirect(CommonHelper::admin('master/instrument-type'));
        }else{
            Session::flash('success', 'Can not find Instrument Type');
            return Redirect(CommonHelper::admin('master/instrument-type'));
        }
    }

    public function instrumentTypeEdit($id){
        $data['_title'] = 'Edit Instrument Type';
        $data['type'] = 'edit';
        $data['item'] = MasterInstrumentTypeModel::where('id',$id)->first();
        $data['list']   = MasterInstrumentTypeModel::where('is_deleted','0')->get();
        return view('admin.master.instrument-type',$data);
    }

    public function instrumentTypeSave(Request $request){
        $instrument = new MasterInstrumentTypeModel;
        $instrument->name  = ucfirst($request->name);
        $instrument->created_by  =  Auth::guard('admin')->user()->id;
        $instrument->updated_by  =  Auth::guard('admin')->user()->id;
        $instrument->save();

        Session::flash('success', 'Instrument Type Created');
        return Redirect::back();
    }

    public function instrumentType() : View{
        $data['_title'] = 'Instrument Type';
        $data['type']   = 'list';
        $data['list']   = MasterInstrumentTypeModel::where('is_deleted','0')->get();
        return view('admin.master.instrument-type',$data);
    }


    //sector

    public function sectorsDelete($id){
        MasterSectorModel::where('id',$id)->update(['is_deleted' => '1']);
        Session::flash('success', 'Sector Deleted');
        return Redirect(CommonHelper::admin('master/sectors'));
    }

    public function sectorsUpdate(Request $request){
        $sector = MasterSectorModel::with('logo')->find($request->item);
        if($sector){
            $sector->name  = ucfirst($request->name);
            $sector->updated_by  =  Auth::guard('admin')->user()->id;
            if($request->hasFile('logo')){
                $sector->logo_id = FileUploadHelper::master_sector($request->file('logo'));
                DocumentHelper::delete($sector->logo);
            }
            $sector->save();

            Session::flash('success', 'Sector Updated');
            return Redirect(CommonHelper::admin('master/sectors'));
        }else{
            Session::flash('success', 'Can not find Sector');
            return Redirect(CommonHelper::admin('master/sectors'));
        }
    }

    public function sectorsEdit($id){
        $data['_title'] = 'Edit Sector';
        $data['type'] = 'edit';
        $data['item'] = MasterSectorModel::where('id',$id)->first();
        $data['list']   = MasterSectorModel::where('is_deleted','0')->get();
        return view('admin.master.sectors',$data);
    }

    public function sectorsSave(Request $request){
        $sector = new MasterSectorModel;
        $sector->name  = ucfirst($request->name);
        $sector->logo_id = FileUploadHelper::master_sector($request->file('logo'));
        $sector->created_by  =  Auth::guard('admin')->user()->id;
        $sector->updated_by  =  Auth::guard('admin')->user()->id;
        $sector->save();

        Session::flash('success', 'Sector Created');
        return Redirect::back();
    }

    public function sectors() : View{
        $data['_title'] = 'Sectors';
        $data['type']   = 'list';
        $data['list']   = MasterSectorModel::where('is_deleted','0')->get();
        return view('admin.master.sectors',$data);
    }

}
