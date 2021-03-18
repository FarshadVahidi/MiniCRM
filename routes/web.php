<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum' , 'verified']], function(){
    Route::get('/dashboard', [DashboardController::class, 'authUser'])->name('dashboard');

    Route::resource('Company', CompanyController::class);
    Route::resource('User', UserController::class);


    Route::get('/clear-all-cache', function () {
        Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        echo "Cleared all caches successfully.";
    });
});

//Route::group(['middleware' => 'auth'], function(){
//    Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function(){
//        Route::resource('user', UserController::class);
//    });
//});
