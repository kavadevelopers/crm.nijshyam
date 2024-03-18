<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\MasterSectorModel;
use App\Models\StartupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StartUpController extends Controller{
    
    public function view() : Response {
        $startup = StartupModel::find(Auth::guard('api-guard')->user()->startup_id);
        return CommonHelper::response('1',[
            'message' => 'StartUp View',
            'data'    => $startup
        ]);
    }

    public function update(Request $request) :Response{
        if(!$request->brand_name){
            return CommonHelper::response('0',['message' => '`brand_name` is reqiured.']);
        }else if(!$request->legal_name){
            return CommonHelper::response('0',['message' => '`legal_name` is reqiured.']);
        }else if(!$request->sector_id){
            return CommonHelper::response('0',['message' => '`sector_id` is reqiured.']);
        }else if(!MasterSectorModel::find($request->sector_id)){
            return CommonHelper::response('0',['message' => '`sector_id` not valid']);
        }else if(!$request->short_description){
            return CommonHelper::response('0',['message' => '`short_description` is reqiured.']);
        }else if(!$request->city){
            return CommonHelper::response('0',['message' => '`city` is reqiured.']);
        }else if(!$request->state){
            return CommonHelper::response('0',['message' => '`state` is reqiured.']);
        }else if(!$request->country){
            return CommonHelper::response('0',['message' => '`country` is reqiured.']);
        }else if(!$request->address){
            return CommonHelper::response('0',['message' => '`address` is reqiured.']);
        }else if(!$request->pincode){
            return CommonHelper::response('0',['message' => '`pincode` is reqiured.']);
        }else{
            if($request->hasFile('logo')){
                if($request->file('logo')->getSize() > CommonHelper::maxFileSizeImage()){
                    return CommonHelper::response('0',['message' => '`logo` size must be less than or equal '.CommonHelper::maxFileSizeImage(true).' MB.']);
                }else if(!in_array($request->file('logo')->getClientOriginalExtension(),CommonHelper::fileExtensionAllowedImage())){
                    return CommonHelper::response('0',['message' => '`logo` allowed only '.implode(',',CommonHelper::fileExtensionAllowedImage()).' extensions']);
                }   
            }

            if($request->hasFile('pitch_deck')){
                if($request->file('pitch_deck')->getSize() > CommonHelper::maxFileSizeDocument()){
                    return CommonHelper::response('0',['message' => '`pitch_deck` size must be less than or equal '.CommonHelper::maxFileSizeDocument(true).' MB.']);
                }else if(!in_array($request->file('pitch_deck')->getClientOriginalExtension(),CommonHelper::fileExtensionAllowedDocument('pdf'))){
                    return CommonHelper::response('0',['message' => '`pitch_deck` allowed only '.implode(',',CommonHelper::fileExtensionAllowedDocument('pdf')).' extensions']);
                }   
            }

            $startup = StartupModel::with('pitch_deck','logo')->find(Auth::guard('api-guard')->user()->startup_id);
            if(!$startup){
                return CommonHelper::response('0',['message' => 'Cant find startup releted to this user']);
            }else{
                $startup->brand_name = $request->brand_name;
                $startup->legal_name = $request->legal_name;
                $startup->sector_id = $request->sector_id;
                $startup->short_description = $request->short_description;
                $startup->city = $request->city;
                $startup->state = $request->state;
                $startup->country = $request->country;
                $startup->address = $request->address;
                $startup->pincode = $request->pincode;
                $startup->cin = NULL;
                $startup->date_of_incorporation = NULL;
                $startup->status = '1';

                if($request->cin){
                    $startup->cin = $request->cin;
                }
                if($request->date_of_incorporation){
                    $startup->date_of_incorporation = $request->date_of_incorporation;
                }
                
                if($request->hasFile('pitch_deck')){
                    $startup->pitch_deck_id = FileUploadHelper::pitch_deck($request->file('pitch_deck'));
                    if($startup->pitch_deck){
                        DocumentHelper::delete($startup->pitch_deck);
                    }
                }

                if($request->hasFile('logo')){
                    $startup->logo_id = FileUploadHelper::startup_logo($request->file('logo'));
                    if($startup->logo){
                        DocumentHelper::delete($startup->logo);
                    }
                }

                $startup->save(); 

                $startup = StartupModel::find(Auth::guard('api-guard')->user()->startup_id);
                return CommonHelper::response('1',[
                    'message' => 'StartUp Updated',
                    'data'    => $startup
                ]);
            }
        }
    }   
}
