<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployeeManagementController extends Controller
{
    public function delete(Request $request) : Response{
        if(!$request->employee_id){
            return CommonHelper::response('0',['message' => '`employee_id` is reqiured.']);
        }else{
            $employee = EmployeeModel::find($request->employee_id);
            if($employee){
                $employee->is_deleted = '1';
                $employee->save();

                return CommonHelper::response('1',[
                    'message' => 'Employee Deleted',
                ]);
            }else{
                return CommonHelper::response('0',[
                    'message' => 'Employee Not Found',
                ]);
            }
        }
    }


    public function update(Request $request) :Response{
        if(!$request->employee_id){
            return CommonHelper::response('0',['message' => '`employee_id` is reqiured.']);
        }else if(!$request->name){
            return CommonHelper::response('0',['message' => '`name` is reqiured.']);
        }else if(!$request->email){
            return CommonHelper::response('0',['message' => '`email` is reqiured.']);
        }else if(!$request->mobile){
            return CommonHelper::response('0',['message' => '`mobile` is reqiured.']);
        }else if(!$request->gender){
            return CommonHelper::response('0',['message' => '`gender` is reqiured.']);
        }else{
            $employee = EmployeeModel::find($request->employee_id);
            if($employee){
                $employee->startup_id  =  Auth::guard('api-guard')->user()->startup_id;
                $employee->name  =  $request->name;
                $employee->email  =  $request->email;
                $employee->mobile  =  $request->mobile;
                $employee->gender  =  $request->gender;
                $employee->department  =  $request->department;
                $employee->position  =  $request->position;
                $employee->address  =  $request->address;
                $employee->date_of_birth  =  $request->date_of_birth;
                $employee->date_of_join	  =  $request->date_of_join;
                $employee->updated_by	  =  Auth::guard('api-guard')->user()->id;
                $employee->save();

                return CommonHelper::response('1',[
                    'message' => 'Employee Updated',
                    'data'    => $employee
                ]);

            }else{
                return CommonHelper::response('0',[
                    'message' => 'Employee Not Found',
                ]);
            }
        } 
    }    
    
    public function list(Request $request):Response{
        if($request->employee_id){
            $employee = EmployeeModel::where('id',$request->employee_id)->first();
            return CommonHelper::response('1',[
                'message'   => 'Employee View',
                'data'      => $employee
            ]);
        }else{
            $employees = EmployeeModel::where('is_deleted','0')->where('startup_id',Auth::guard('api-guard')->user()->startup_id);
            if($request->skip){
                $employees->skip($request->skip);
            }
            if($request->take){
                $employees->take($request->take);

            }
            $employees = $employees->get();
            return CommonHelper::response('1',[
                'message'   => 'Employee List',
                'data'      => $employees,
                'note'      => 'Pass take if you want to `take` records and `skip` for skip records'
            ]);
        }
    }

    public function create(Request $request) : Response{
        if(!$request->name){
            return CommonHelper::response('0',['message' => '`name` is reqiured.']);
        }else if(!$request->email){
            return CommonHelper::response('0',['message' => '`email` is reqiured.']);
        }else if(!$request->mobile){
            return CommonHelper::response('0',['message' => '`mobile` is reqiured.']);
        }else if(!$request->gender){
            return CommonHelper::response('0',['message' => '`gender` is reqiured.']);
        }else{
            $employee = new EmployeeModel();
            $employee->startup_id  =  Auth::guard('api-guard')->user()->startup_id;
            $employee->name  =  $request->name;
            $employee->email  =  $request->email;
            $employee->mobile  =  $request->mobile;
            $employee->gender  =  $request->gender;
            $employee->department  =  $request->department;
            $employee->position  =  $request->position;
            $employee->address  =  $request->address;
            $employee->date_of_birth  =  $request->date_of_birth;
            $employee->date_of_join	  =  $request->date_of_join;
            $employee->created_by	  =  Auth::guard('api-guard')->user()->id;
            $employee->updated_by	  =  Auth::guard('api-guard')->user()->id;
            $employee->save();

            return CommonHelper::response('1',[
                'message' => 'Employee Created',
                'data'    => $employee
            ]);
        }        
    }
}
