<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderDetailController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes untuk Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Routes untuk pengguna terautentikasi
Route::middleware(['auth:api'])->group(function () {
    // Informasi pengguna
    Route::get('/user', fn(Request $request) => $request->user());

    // Routes untuk admin dan staff
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'update', 'destroy']);
    });

    // Routes untuk customer
    Route::middleware(['role:customer'])->group(function () {
        Route::apiResource('/orders', OrderController::class)->only(['index', 'store', 'show']);
        Route::apiResource('/orderdetails', OrderDetailController::class)->only(['index', 'store', 'show']);
        Route::apiResource('/paymentmethods', PaymentMethodController::class)->only(['index','store']);
    });
});

// Routes publik (tanpa autentikasi)
Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);
