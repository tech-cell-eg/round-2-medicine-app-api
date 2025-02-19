<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
});

Route::post('verify-phone' , [UserController::class , 'verifyPhoneOtp']);
