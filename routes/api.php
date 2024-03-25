<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookingController;

Route::post("user-registration", [UserController::class, 'registration']);
Route::post("user-login", [UserController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('doctor-list',[UserController::class, 'doctorList']);
    Route::post('appointment',[BookingController::class, 'bookAppointment']);
    Route::get('appointment-list',[UserController::class, 'appointmentList']);
    Route::put('appointment',[BookingController::class, 'updateAppointment']);
});