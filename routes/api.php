<?php

use App\Helpers\CommonHelper;
use App\Http\Controllers\api\v1\AuthController as ApiAuthController;
use App\Http\Controllers\api\v1\ConfigController;
use App\Http\Controllers\api\v1\MasterController as ApiMasterController;
use App\Http\Controllers\api\v1\user\EmployeeManagementController as ApiEmployeeController;
use App\Http\Controllers\api\v1\user\FinancialDocumentController as ApiFinancialDocumentController;
use App\Http\Controllers\api\v1\user\MisController as ApiMisController;
use App\Http\Controllers\api\v1\user\StartUpController as ApiStartUpController;
use App\Http\Controllers\api\v1\user\UserController as ApiUserController;
use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

route::get('',[Controller::class,'test']);

Route::middleware('auth.api.token')->group(function(){
    Route::prefix('v1')->group(function(){

        Route::get('test',function(){
            return CommonHelper::response(1,['sample' => 'Okay']);
        });

        Route::post('login',[ApiAuthController::class,'login']);
        
        Route::prefix('forgot')->group(function(){
            Route::post('verify-user',[ApiAuthController::class,'forgotVerifyUser']);
            Route::post('verify-code',[ApiAuthController::class,'forgotVerifyCode']);
            Route::post('reset-password',[ApiAuthController::class,'resetPassword']);
        });  
        
        Route::middleware('auth:api-guard')->group(function(){
            Route::get('profile',[ApiUserController::class,'getUser']); 

            Route::prefix('startup')->group(function(){
                route::get('',[ApiStartUpController::class,'view']);
                route::post('update',[ApiStartUpController::class,'update']);
            });
            
            Route::prefix('employee')->group(function(){
                route::get('',[ApiEmployeeController::class,'list']);
                route::post('create',[ApiEmployeeController::class,'create']);
                route::post('update',[ApiEmployeeController::class,'update']);
                route::post('delete',[ApiEmployeeController::class,'delete']);
            });

            Route::prefix('mis')->group(function(){
                route::get('',[ApiMisController::class,'list']);
                route::post('create',[ApiMisController::class,'create']);
                route::post('update',[ApiMisController::class,'update']);
                route::post('delete',[ApiMisController::class,'delete']);
                route::post('send',[ApiMisController::class,'send']);
            });

            Route::prefix('financial-document')->group(function(){
                route::get('',[ApiFinancialDocumentController::class,'list']);
                route::post('create',[ApiFinancialDocumentController::class,'create']);
                route::post('update',[ApiFinancialDocumentController::class,'update']);
                route::post('delete',[ApiFinancialDocumentController::class,'delete']);
                route::post('send',[ApiFinancialDocumentController::class,'send']);

            });


            Route::post('logout',[ApiUserController::class,'logout']);   
        });  

        Route::prefix('master')->group(function(){
            Route::prefix('sector')->group(function(){
                route::get('',[ApiMasterController::class,'sectorList']);
                route::post('create',[ApiMasterController::class,'createSector']);
            });


            Route::prefix('instrument-type')->group(function(){
                route::get('',[ApiMasterController::class,'instrumentTypeList']);
                route::post('create',[ApiMasterController::class,'instrumentTypeCreate']);
                route::post('update',[ApiMasterController::class,'instrumentTypeUpdate']);
                route::post('delete',[ApiMasterController::class,'instrumentTypeDelete']);
            });


            Route::prefix('investortype')->group(function(){
                route::get('',[ApiMasterController::class,'investorTypeList']);
                route::post('create',[ApiMasterController::class,'investorTypeCreate']);
                route::post('update',[ApiMasterController::class,'investorTypeUpdate']);
                route::post('delete',[ApiMasterController::class,'investorTypeDelete']);
            });

            Route::prefix('country')->group(function(){
                route::get('',[ApiMasterController::class,'countryList']);
            });

            Route::prefix('state')->group(function(){
                route::get('',[ApiMasterController::class,'stateList']);
            });

            Route::prefix('city')->group(function(){
                route::get('',[ApiMasterController::class,'cityList']);
            });
        });

        Route::get('get-config',[ConfigController::class,'get']);
    });
});
