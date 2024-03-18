<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\MasterController;
use App\Http\Controllers\admin\SettingsController;
use App\Models\StartupModel;
use App\Models\UserStartUpModel;
use App\Models\ZApiTokenModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('generate-bearer-token', function () {
    $token = Str::random(60);
    ZApiTokenModel::create([
        'token' => $token
    ]);
    return $token;
});

Route::get('generate-startup-user', function () {

    $startup = new StartupModel;
    $startup->brand_name = 'Test Brand name';
    $startup->legal_name = 'Test legal_name';
    $startup->save();

    $user = new UserStartUpModel;
    $user->startup_id = $startup->id;
    $user->name = 'Mehul Kava';
    $user->mobile = '9898375981';
    $user->password = Hash::make('Shuru@123');
    $user->email = 'mehul9921@gmail.com';
    $user->save();

});

Route::prefix('admin')->group(function(){

    Route::group(['middleware' => ['isGuest']],function(){
        Route::get('', [LoginController::class,'index']);
        Route::get('/login', [LoginController::class,'index']);
        Route::post('/login', [LoginController::class,'login']);
        Route::get('/forget-password', [LoginController::class,'forget']);
        Route::post('/forget-check', [LoginController::class,'forgetCheck']);
        Route::post('/reset-password', [LoginController::class,'resetPassword']);
    });

    Route::group(['middleware' => ['isAdmin']],function(){

        Route::get('/dashboard', [DashboardController::class,'index']);

        Route::prefix('master')->group(function(){
            Route::prefix('sectors')->group(function(){
                Route::get('', [MasterController::class,'sectors']);
                Route::get('edit/{id}', [MasterController::class,'sectorsEdit']);
                Route::get('delete/{id}', [MasterController::class,'sectorsDelete']);

                Route::post('save', [MasterController::class,'sectorsSave']);
                Route::post('update', [MasterController::class,'sectorsUpdate']);
            });

            Route::prefix('investortype')->group(function(){
                Route::get('', [MasterController::class,'investorType']);
                Route::get('edit/{id}', [MasterController::class,'investorTypeEdit']);
                Route::get('delete/{id}', [MasterController::class,'investorTypeDelete']);

                Route::post('save', [MasterController::class,'investorTypeSave']);
                Route::post('update', [MasterController::class,'investorTypeUpdate']);
            });

            Route::prefix('instrument-type')->group(function(){
                Route::get('', [MasterController::class,'instrumentType']);
                Route::get('edit/{id}', [MasterController::class,'instrumentTypeEdit']);
                Route::get('delete/{id}', [MasterController::class,'instrumentTypeDelete']);

                Route::post('save', [MasterController::class,'instrumentTypeSave']);
                Route::post('update', [MasterController::class,'instrumentTypeUpdate']);
            });

            Route::prefix('country')->group(function(){
                Route::get('', [MasterController::class,'country']);
                Route::get('edit/{id}', [MasterController::class,'countryEdit']);
                Route::get('delete/{id}', [MasterController::class,'countryDelete']);

                Route::post('save', [MasterController::class,'countrySave']);
                Route::post('update', [MasterController::class,'countryUpdate']);
            });

            Route::prefix('state')->group(function(){
                Route::get('', [MasterController::class,'state']);
                Route::get('edit/{id}', [MasterController::class,'stateEdit']);
                Route::get('delete/{id}', [MasterController::class,'stateDelete']);

                Route::post('save', [MasterController::class,'stateSave']);
                Route::post('update', [MasterController::class,'stateUpdate']);
            });

            Route::prefix('city')->group(function(){
                Route::get('', [MasterController::class,'city']);
                Route::get('edit/{id}', [MasterController::class,'cityEdit']);
                Route::get('delete/{id}', [MasterController::class,'cityDelete']);

                Route::post('save', [MasterController::class,'citySave']);
                Route::post('update', [MasterController::class,'cityUpdate']);
            });
        });

        Route::prefix('settings')->group(function(){
            Route::get('', [SettingsController::class,'index']);
            Route::post('', [SettingsController::class,'save']);
        });

        Route::prefix('profile')->group(function(){
            Route::get('', [SettingsController::class,'profile']);
            Route::post('save', [SettingsController::class,'profileSave']);
        });
    });

});
