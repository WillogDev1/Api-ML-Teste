<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\IntegrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/produtos', [ProductController::class, 'store'])->name('produtos.store');
    Route::get('/create-product', [ProductController::class, 'createProduct']);
    Route::get('/obter-token', [ProductController::class, 'getToken']);
    Route::get('/integracao', [ProductController::class, 'showIntegration']);
    Route::post('/renovar-token', [ProductController::class, 'refreshToken'])->name('renovar-token');
});
