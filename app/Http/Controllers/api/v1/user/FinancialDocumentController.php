<?php

namespace App\Http\Controllers\api\v1\user;

use App\Enums\SendTypeEnum;
use App\Helpers\CommonHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\FinancialDocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FinancialDocumentController extends Controller{
    
    public function send(Request $request){
        if(!$request->financial_id){
            return CommonHelper::response('0',['message' => '`financial_id` is reqiured.']);
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
        if(!$request->financial_id){
            return CommonHelper::response('0',['message' => '`financial_id` is reqiured.']);
        }else{
            $financial = FinancialDocumentModel::with('document')->find($request->financial_id);
            if($financial){
                DocumentHelper::delete($financial->document);
                $financial->is_deleted = '1';
                $financial->document_id = NULL;
                $financial->save();
                return CommonHelper::response('1',[
                    'message' => 'Financial Document Deleted',
                ]);
            }else{
                return CommonHelper::response('0',[
                    'message' => 'Financial Document Not Found',
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

        if(!$request->financial_id){
            return CommonHelper::response('0',['message' => '`financial_id` is reqiured.']);
        }else{
            $financial = FinancialDocumentModel::with('document')->find($request->financial_id);
            if($financial){
                if($request->hasFile('document')){
                    $financial->document_id = FileUploadHelper::financial($request->file('document'));
                    DocumentHelper::delete($financial->document);
                }
                $financial->startup_id = Auth::guard('api-guard')->user()->startup_id;
                $financial->description = $request->description;
                $financial->save();    
                $financial = FinancialDocumentModel::find($request->financial_id);
                return CommonHelper::response('1',[
                    'message' => 'Financial Document Updated',
                    'data'    => $financial
                ]);

            }else{
                return CommonHelper::response('0',[
                    'message' => 'Financial Document Not Found',
                ]);
            }
        } 
    }   
   
    public function list(Request $request) :Response{
        if($request->financial_id){
            $financial = FinancialDocumentModel::where('id',$request->financial_id)->first();
            return CommonHelper::response('1',[
                'message' => 'Financial Document View',
                'data'    => $financial
            ]);
        }else{
            $financial = FinancialDocumentModel::where('is_deleted','0')->where('startup_id',Auth::guard('api-guard')->user()->startup_id);
            if($request->skip){
                $financial->skip($request->skip);
            }
            if($request->take){
                $financial->take($request->take);

            }
            $financial = $financial->get();
            return CommonHelper::response('1',[
                'message'   => 'Financial Document List',
                'data'      => $financial,
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
            $financial = new FinancialDocumentModel();
            $financial->document_id = FileUploadHelper::financial($request->file('document'));
            $financial->startup_id = Auth::guard('api-guard')->user()->startup_id;
            $financial->description = $request->description;
            $financial->save();    

            return CommonHelper::response('1',[
                'message' => 'Financial Document Created',
                'data'    => $financial
            ]);
        }
    }
}
