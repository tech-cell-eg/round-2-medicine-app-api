<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/notifications', [NotificationController::class, 'getNotifications']);
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::get('/products', [productController::class, 'index']);
Route::get('/products/{$id}', [productController::class, 'show']);
Route::post('cart/add', [cartController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('verify-phone', [UserController::class, 'verifyPhoneOtp']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [categoryController::class, 'index']);
});


