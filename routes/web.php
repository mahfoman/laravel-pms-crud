<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products',  'index');
    Route::get('/products/create',  'create');
    Route::post('/products',  'store');
    Route::get('/products/{id}',  'show');
    Route::get('/products/{id}/edit',  'edit');
    Route::put('/products/{id}', 'update');
    Route::delete('/products/{id}',  'destroy');
});
