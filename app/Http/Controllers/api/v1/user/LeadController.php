<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\LeadsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LeadController extends Controller{
    
    public function list(Request $request):Response{
        if($request->lead_id){
            $lead = LeadsModel::where('id',$request->lead_id)->with('source','product')->first();
            return CommonHelper::response('1',[
                'message'   => 'Lead View',
                'data'      => $lead
            ]);
        }else{
            $leads = LeadsModel::orderby('id','asc')->with('source','product');
            if($request->skip){
                $leads->skip($request->skip);
            }
            if($request->take){
                $leads->take($request->take);
            }
            $leads = $leads->get();
            return CommonHelper::response('1',[
                'message'   => 'Lead List',
                'data'      => $leads,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }

    function create(Request $request) : Response {
        

        if(!$request->priority){
            return CommonHelper::response('0',['message' => '`priority` is reqiured.']);
        }else if(!$request->name){
            return CommonHelper::response('0',['message' => '`name` is reqiured.']);
        }else if(!$request->mobile){
            return CommonHelper::response('0',['message' => '`mobile` is reqiured.']);
        }else if(!$request->source_id){
            return CommonHelper::response('0',['message' => '`source_id` is reqiured.']);
        }else if(!$request->product_id){
            return CommonHelper::response('0',['message' => '`product_id` is reqiured.']);
        }else if(!$request->status){
            return CommonHelper::response('0',['message' => '`status` is reqiured.']);
        }else{

            $lead = new LeadsModel;
            $lead->priority         = $request->priority;
            $lead->source_id        = $request->source_id;
            $lead->product_id       = $request->product_id;
            $lead->lead_id          = NULL;
            $lead->name             = $request->name;
            $lead->mobile           = $request->mobile;
            $lead->email            = $request->email;
            $lead->city             = $request->city;
            $lead->address          = $request->address;
            $lead->description      = $request->description;
            if($request->follow_up_date){
                $lead->follow_up_date   = Carbon::parse($request->follow_up_date)->format('Y-m-d');
            }
            $lead->status           = $request->status;
            $lead->created_by       = Auth::guard('api-guard')->user()->id;
            $lead->updated_by       = Auth::guard('api-guard')->user()->id;
            $lead->save();   
            
            $lead->lead_id          = CommonHelper::generateLeadId($lead->id);
            $lead->save();

            return CommonHelper::response('1',[
                'message' => 'Lead Created',
                'data'    => $lead
            ]);

        }    
    }
}
