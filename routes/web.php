<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/', function () {return view('home');});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/products' , [productController::class , 'viewProducts'])->name('products');
    Route::get('/products/{id}', [ProductController::class, 'viewProductDetails'])->name('products.show');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('site/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::resource('users', UserController::class);

}
    
);


