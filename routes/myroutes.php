<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users',UserController::class) ;
Route::resource('attendance',AttendanceController::class) ;
