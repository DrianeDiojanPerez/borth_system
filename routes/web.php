<?php

use App\Http\Controllers\PaclingListController;
use App\Http\Controllers\UploadConroller;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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
//upload for any file to upload a file rather than the avater file 
Route::post('upload',[UploadConroller::class,'store']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:Administrator', 'prefix' => 'Administrator', 'as' => 'Administrator.'], function() {
        Route::resource('home', \App\Http\Controllers\Administrator\homeController::class);
    });
   Route::group(['middleware' => 'role:Cashier', 'prefix' => 'Cashier', 'as' => 'Cashier.'], function() {
       Route::resource('home', \App\Http\Controllers\Cashier\homeController::class);
       Route::get('/search',[\App\Http\Controllers\Cashier\homeController::class, 'searchselect']);
       Route::post('/print', [\App\Http\Controllers\Cashier\homeController::class, 'print']);
       Route::get('/downloadPDF/{id}',[App\Http\Controllers\PaymentController::class, 'downloadPDF']);
       

       Route::post('search', [\App\Http\Controllers\Cashier\homeController::class, 'search']);
       Route::resource('payment', App\Http\Controllers\PaymentController::class);
   });
    Route::group(['middleware' => 'role:Supervisor', 'prefix' => 'Supervisor', 'as' => 'Supervisor.'], function() {
        Route::resource('home', \App\Http\Controllers\Supervisor\homeController::class);
        Route::resource('Packing', App\Http\Controllers\PaclingListController::class);
        // Route::post('storePacking',  [App\Http\Controllers\PaclingListController::class, 'store'] );
        
    });
});
