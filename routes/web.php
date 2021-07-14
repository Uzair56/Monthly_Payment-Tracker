<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/home',[HomeController::class,'index']);
    Route::get('/cleared-payments',[HomeController::class,'clearedPayments']);
    Route::post('/add-user',[HomeController::class,'addUser']);
    Route::get('/add-payment',[HomeController::class,'addPayment']);
    Route::get('edit-payment/{id}',[HomeController::class,'edit']);
    Route::post('update-payment/{id}',[HomeController::class,'update']);
    Route::post('/store-payments',[HomeController::class,'store'])->name('payments.store');
    Route::delete('delete-payment/{id}',[HomeController::class,'destroy']);
    Route::post('clear-payment/{id}',[HomeController::class,'clear']);
});

