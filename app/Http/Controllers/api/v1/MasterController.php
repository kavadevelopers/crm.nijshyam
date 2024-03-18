<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\CommonHelper;
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
use Symfony\Component\HttpFoundation\Response;

class MasterController extends Controller{

    //city


    public function cityList(Request $request) : Response{
        $city = MaterCityModel::where('is_deleted','0');
        if($request->country_id){
            $city->where('country_id',$request->country_id);
        }
        if($request->state_id){
            $city->where('state_id',$request->state_id);
        }
        if($request->skip){
            $city->skip($request->skip);
        }
        if($request->take){
            $city->take($request->take);

        }
        $city = $city->get();
        return CommonHelper::response('1',[
            'message'   => 'City List',
            'data'      => $city,
            'note'      => 'country_id` & `state_id` Optional. Pass take if you want to `take` records and `skip` for skip records'
        ]);
    }

    // state
    public function stateList(Request $request) : Response{
        $state = MaterStateModel::where('is_deleted','0');
        if($request->country_id){
            $state->where('country_id',$request->country_id);
        }
        if($request->skip){
            $state->skip($request->skip);
        }
        if($request->take){
            $state->take($request->take);

        }
        $state = $state->get();
        return CommonHelper::response('1',[
            'message'   => 'State List',
            'data'      => $state,
            'note'      => '`country_id` Optional. Pass take if you want to `take` records and `skip` for skip records'
        ]);
    }

    //Country
    public function countryList(Request $request) : Response{
        $country = MaterCountryModel::where('is_deleted','0');
        if($request->skip){
            $country->skip($request->skip);
        }
        if($request->take){
            $country->take($request->take);

        }
        $country = $country->get();
        return CommonHelper::response('1',[
            'message'   => 'Country List',
            'data'      => $country,
            'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
        ]);
    }


    // investortype

    public function investorTypeList(Request $request) : Response{
        if($request->investor_type_id){
            $investor = MasterInvestorTypeModel::where('id',$request->investor_type_id)->first();
            return CommonHelper::response('1',[
                'message'   => 'Investor Type View',
                'data'      => $investor
            ]);
        }else{
            $investor = MasterInvestorTypeModel::where('is_deleted','0');
            if($request->skip){
                $investor->skip($request->skip);
            }
            if($request->take){
                $investor->take($request->take);

            }
            $investor = $investor->get();
            return CommonHelper::response('1',[
                'message'   => 'Investor Type List',
                'data'      => $investor,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }
    
    //insturment

    public function instrumentTypeList(Request $request) : Response{
        if($request->instrument_type_id){
            $instrument = MasterInstrumentTypeModel::where('id',$request->instrument_type_id)->first();
            return CommonHelper::response('1',[
                'message'   => 'Instrument Type View',
                'data'      => $instrument
            ]);
        }else{
            $instrument = MasterInstrumentTypeModel::where('is_deleted','0');
            if($request->skip){
                $instrument->skip($request->skip);
            }
            if($request->take){
                $instrument->take($request->take);

            }
            $instrument = $instrument->get();
            return CommonHelper::response('1',[
                'message'   => 'Instrument Type List',
                'data'      => $instrument,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }

    // public function instrumentTypeDelete(Request $request){
    //     if(!$request->instrument_id){
    //         return CommonHelper::response('0',['message' => '`instrument_id` is reqiured.']);
    //     }else{
    //         $instrument = MasterInstrumentTypeModel::find($request->instrument_id);
    //         if($instrument){
    //             $instrument->is_deleted = '1';
    //             $instrument->save();

    //             return CommonHelper::response('1',[
    //                 'message' => 'Instrument Type Deleted',
    //             ]);
    //         }else{
    //             return CommonHelper::response('0',[
    //                 'message' => 'Instrument Type Not Found',
    //             ]);
    //         }
    //     }
    // }

    // public function instrumentTypeUpdate(Request $request) : Response{
    //     if(!$request->instrument_id){
    //         return CommonHelper::response('0',['message' => '`instrument_id` is reqiured.']);
    //     }else if(!$request->name){
    //         return CommonHelper::response('0',['message' => '`name` is reqiured.']);
    //     }else{
    //         $instrument = MasterInstrumentTypeModel::find($request->instrument_id);
    //         if($instrument){
    //             $instrument->name = $request->name;
    //             $instrument->save();

    //             return CommonHelper::response('1',[
    //                 'message' => 'Instrument Type Updated',
    //                 'data'    => $instrument
    //             ]);

    //         }else{
    //             return CommonHelper::response('0',[
    //                 'message' => 'Instrument Type Not Found',
    //             ]);
    //         }
    //     }
    // }


    
    
    // public function instrumentTypeCreate(Request $request) :Response{
    //     if(!$request->name){
    //         return CommonHelper::response('0',['message' => '`name` is reqiured.']);
    //     }else{
    //         $instrument = new MasterInstrumentTypeModel;
    //         $instrument->name = $request->name;
    //         $instrument->save();

    //         return CommonHelper::response('1',[
    //             'message' => 'Instrument Type Created',
    //             'data'    => $instrument
    //         ]);
    //     }
    // }


    //sector
    public function sectorList(Request $request) :Response{
        if($request->sector_id){
            $sector = MasterSectorModel::find($request->sector_id);
            return CommonHelper::response('1',[
                'message' => 'Sector View',
                'data'    => $sector
            ]);
        }else{
            $sectors = MasterSectorModel::where('is_deleted','0');
            if($request->skip){
                $sectors->skip($request->skip);
            }
            if($request->take){
                $sectors->take($request->take);

            }
            $sectors = $sectors->get();
            return CommonHelper::response('1',[
                'message'   => 'Sector List',
                'data'      => $sectors,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }

    public function createSector(Request $request) : Response {
        if(!$request->name){
            return CommonHelper::response('0',['message' => '`name` is reqiured.']);
        }else if (!$request->hasFile('logo')){
            return CommonHelper::response('0',['message' => '`logo` file is reqiured.']);
        }else if($request->file('logo')->getSize() > CommonHelper::maxFileSizeImage()){
            return CommonHelper::response('0',['message' => '`logo` size must be less than or equal '.CommonHelper::maxFileSizeImage(true).' MB.']);
        }else if(!in_array($request->file('logo')->getClientOriginalExtension(),CommonHelper::fileExtensionAllowedImage())){
            return CommonHelper::response('0',['message' => 'Only '.implode(',',CommonHelper::fileExtensionAllowedImage()).' files are allowed']);
        }else{
            $sector = new MasterSectorModel;
            $sector->name = $request->name;
            $sector->logo_id = FileUploadHelper::master_sector($request->file('logo'));
            $sector->save();

            $sector = MasterSectorModel::find($sector->id);
            return CommonHelper::response('1',[
                'message' => 'Sector Created',
                'data'    => $sector
            ]);
        }
    }
}
