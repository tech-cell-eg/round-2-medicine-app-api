<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/notifications/{id}', [NotificationController::class, 'getNotifications']);
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::post('verify-phone', [UserController::class, 'verifyPhoneOtp']);
Route::get('/products', [productController::class, 'index']);
Route::get('/products/{id}', [productController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{categoryId}', [productController::class, 'listCategoryProducts']);
Route::get('/sub-categories/{name}', [productController::class, 'listSubCategoryProducts']);
Route::post('cart/add', [cartController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/checkout/{id}', [CartController::class, 'checout']);





