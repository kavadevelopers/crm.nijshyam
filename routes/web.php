<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\MasterController;
use App\Http\Controllers\admin\SettingsController;
use App\Models\StartupModel;
use App\Models\UserStartUpModel;
use App\Models\ZApiTokenModel;
use Illuminate\Support\Facades\Artisan;
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
            Route::prefix('products')->group(function(){
                Route::get('', [MasterController::class,'products']);
                Route::get('edit/{id}', [MasterController::class,'productsEdit']);
                Route::get('delete/{id}', [MasterController::class,'productsDelete']);

                Route::post('save', [MasterController::class,'productsSave']);
                Route::post('update', [MasterController::class,'productsUpdate']);
            });

            Route::prefix('source')->group(function(){
                Route::get('', [MasterController::class,'source']);
                Route::get('edit/{id}', [MasterController::class,'sourceEdit']);
                Route::get('delete/{id}', [MasterController::class,'sourceDelete']);

                Route::post('save', [MasterController::class,'sourceSave']);
                Route::post('update', [MasterController::class,'sourceUpdate']);
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

Route::get('site-optimize', function () {
    Artisan::call("optimize");
});
Route::get('site-optimize-clear', function () {
    Artisan::call("optimize:clear");
});
Route::get('storage-generate', function () {
    Artisan::call("storage:link");
});

Route::get('db-migration', function () {
    Artisan::call("migrate");
});
