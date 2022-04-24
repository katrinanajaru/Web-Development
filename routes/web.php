<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubserviceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;



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
    return redirect()->route("login") ;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('appointments', AppointmentController::class);// Appointments
Route::resource('services', ServiceController::class);// Services
Route::resource('subservices', SubserviceController::class);// subservice

Route::resource('users',UserController::class) ;
Route::resource('attendance',AttendanceController::class) ;
Route::get('wallet',[WalletController::class,'index'])->name('wallet.index') ;
Route::post('pay/service/{appointment}',[AppointmentController::class,'payAppointment'])->name('payAppointment') ;
Route::post('appointment/approve/{appointment}',[AppointmentController::class,'approveAppointment'])->name('approveAppointment') ;
Route::resource('billings',BillingController::class) ;
