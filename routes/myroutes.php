<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::resource('users',UserController::class) ;
Route::resource('attendance',AttendanceController::class) ;
Route::get('wallet',[WalletController::class,'index'])->name('wallet.index') ;
Route::post('pay/service/{appointment}',[AppointmentController::class,'payAppointment'])->name('payAppointment') ;
Route::post('appointment/approve/{appointment}',[AppointmentController::class,'approveAppointment'])->name('approveAppointment') ;
