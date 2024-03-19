<?php

use App\Helpers\CommonHelper;
use App\Http\Controllers\api\v1\AuthController as ApiAuthController;
use App\Http\Controllers\api\v1\user\UserController as ApiUserController;
use App\Http\Controllers\Controller;
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
        
        Route::middleware('auth:api-guard')->group(function(){
            Route::get('profile',[ApiUserController::class,'getUser']); 


            Route::post('logout',[ApiUserController::class,'logout']);   
        });  

        // Route::prefix('master')->group(function(){
        //     Route::prefix('sector')->group(function(){
        //         route::get('',[ApiMasterController::class,'sectorList']);
        //         route::post('create',[ApiMasterController::class,'createSector']);
        //     });


        //     Route::prefix('instrument-type')->group(function(){
        //         route::get('',[ApiMasterController::class,'instrumentTypeList']);
        //         route::post('create',[ApiMasterController::class,'instrumentTypeCreate']);
        //         route::post('update',[ApiMasterController::class,'instrumentTypeUpdate']);
        //         route::post('delete',[ApiMasterController::class,'instrumentTypeDelete']);
        //     });


        //     Route::prefix('investortype')->group(function(){
        //         route::get('',[ApiMasterController::class,'investorTypeList']);
        //         route::post('create',[ApiMasterController::class,'investorTypeCreate']);
        //         route::post('update',[ApiMasterController::class,'investorTypeUpdate']);
        //         route::post('delete',[ApiMasterController::class,'investorTypeDelete']);
        //     });

        //     Route::prefix('country')->group(function(){
        //         route::get('',[ApiMasterController::class,'countryList']);
        //     });

        //     Route::prefix('state')->group(function(){
        //         route::get('',[ApiMasterController::class,'stateList']);
        //     });

        //     Route::prefix('city')->group(function(){
        //         route::get('',[ApiMasterController::class,'cityList']);
        //     });
        // });
        // Route::get('get-config',[ConfigController::class,'get']);
    });
});
