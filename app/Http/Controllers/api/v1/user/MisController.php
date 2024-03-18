<?php

namespace App\Http\Controllers\api\v1\user;

use App\Enums\SendTypeEnum;
use App\Helpers\AwsS3Helper;
use App\Helpers\CommonHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\MisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\HttpFoundation\Response;



class MisController extends Controller{


    public function send(Request $request){
        if(!$request->mis_id){
            return CommonHelper::response('0',['message' => '`mis_id` is reqiured.']);
        }else if(!$request->type){
            return CommonHelper::response('0',['message' => '`type` is reqiured.']);
        }else if(!in_array($request->type,[SendTypeEnum::EMAIL,SendTypeEnum::WHATSAPP])){
            return CommonHelper::response('0',['message' => 'only ' .SendTypeEnum::EMAIL.' or '.SendTypeEnum::WHATSAPP.' type is reqiured.']);
        }else if(!$request->values){
            return CommonHelper::response('0',['message' => '`values` is reqiured.']);
        }else if(!is_array($request->values)){
            return CommonHelper::response('0',['message' => '`values` reuired array']);
        }else{
            return CommonHelper::response('1',[
                'message' => 'Message sent',
            ]);
        }
    } 
 
    public function delete(Request $request) : Response{
        if(!$request->mis_id){
            return CommonHelper::response('0',['message' => '`mis_id` is reqiured.']);
        }else{
            $mis = MisModel::with('document')->find($request->mis_id);
            if($mis){
                DocumentHelper::delete($mis->document);
                $mis->is_deleted = '1';
                $mis->document_id = NULL;
                $mis->save();
                return CommonHelper::response('1',[
                    'message' => 'Mis Deleted',
                ]);
            }else{
                return CommonHelper::response('0',[
                    'message' => 'Mis Not Found',
                ]);
            }
        }
    }

    public function update(Request $request) :Response{
        if($request->hasFile('document')){
            if($request->file('document')->getSize() > CommonHelper::maxFileSizeDocument()){
                return CommonHelper::response('0',['message' => '`document` size must be less than or equal '.CommonHelper::maxFileSizeDocument(true).' MB.']);
            }else if(!in_array($request->file('document')->getClientOriginalExtension(),CommonHelper::fileExtensionAllowedDocument())){
                return CommonHelper::response('0',['message' => 'Only '.implode(',',CommonHelper::fileExtensionAllowedDocument()).' files are allowed']);
            }   
        }

        if(!$request->mis_id){
            return CommonHelper::response('0',['message' => '`mis_id` is reqiured.']);
        }else{
            $mis = MisModel::with('document')->find($request->mis_id);
            if($mis){
                if($request->hasFile('document')){
                    $mis->document_id = FileUploadHelper::mis($request->file('document'));
                    DocumentHelper::delete($mis->document);
                }
                $mis->startup_id = Auth::guard('api-guard')->user()->startup_id;
                $mis->description = $request->description;
                $mis->save();    
                $mis = MisModel::find($request->mis_id);
                return CommonHelper::response('1',[
                    'message' => 'Mis Updated',
                    'data'    => $mis
                ]);
            }else{
                return CommonHelper::response('0',[
                    'message' => 'Mis Not Found',
                ]);
            }
        } 
    }   
   
    public function list(Request $request) :Response{
        if($request->mis_id){
            $mis = MisModel::where('id',$request->mis_id)->first();
            return CommonHelper::response('1',[
                'message' => 'Mis View',
                'data'    => $mis
            ]);
        }else{
            $mis = MisModel::where('is_deleted','0')->where('startup_id',Auth::guard('api-guard')->user()->startup_id);
            if($request->skip){
                $mis->skip($request->skip);
            }
            if($request->take){
                $mis->take($request->take);

            }
            $mis = $mis->get();
            return CommonHelper::response('1',[
                'message'   => 'Mis List',
                'data'      => $mis,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }

    public function create(Request $request) :Response{
        if (!$request->hasFile('document')){
            return CommonHelper::response('0',['message' => '`document` is reqiured.']);
        }else if($request->file('document')->getSize() > CommonHelper::maxFileSizeDocument()){
            return CommonHelper::response('0',['message' => '`document` size must be less than or equal '.CommonHelper::maxFileSizeDocument(true).' MB.']);
        }else if(!in_array($request->file('document')->getClientOriginalExtension(),CommonHelper::fileExtensionAllowedDocument())){
            return CommonHelper::response('0',['message' => 'Only '.implode(',',CommonHelper::fileExtensionAllowedDocument()).' files are allowed']);
        }else{
            $mis = new MisModel;
            $mis->document_id = FileUploadHelper::mis($request->file('document'));
            $mis->startup_id = Auth::guard('api-guard')->user()->startup_id;
            $mis->description = $request->description;
            $mis->save();    

            return CommonHelper::response('1',[
                'message' => 'Mis Created',
                'data'    => $mis
            ]);
        }
    }

}
