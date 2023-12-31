<?php

use App\Http\Controllers\InterestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


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



// UserController
Route::controller(UserController::class)->group(function(){
    Route::get('/','login');
    Route::post('/login/process','process');
    Route::get('/register','register');
    Route::post('/user/store','store');
    Route::post('/logout','logout');
});

Route::controller(LoanController::class)->group(function(){
    Route::get('/home','index');
    Route::get('/show/{id}/','show');    
    Route::get('/create/loan','create');
    Route::post('/store/loan','store');   
    Route::post('/get/loan','get');  
    Route::post('/store/get/loan/','storegetloan');  
    Route::get('/loan/list','list');
    Route::get('/request/loan','request');
    Route::get('loan/data/{id}','request_data');
    Route::get('/show/request/{id}','show_request');
    Route::post('/approve/loan/{id}','approve');

});

Route::controller(InterestController::class)->group(function(){
    Route::get('/create/interest/{id}','create');
    Route::post('/store/interest/{id}','store');    
});

Route::controller(PaymentController::class)->group(function(){
    Route::get('/user/monthly/invoice','user');
    Route::get('/borrows/monthly/invoice','borrow');
    Route::post('/search/user/invoice','search');

    
    
});

