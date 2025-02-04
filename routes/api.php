<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderDetailController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes untuk Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/payment_methods', PaymentMethodController::class)->only(['index']);

// Routes untuk pengguna terautentikasi
Route::middleware(['auth:api'])->group(function () {

    // Informasi pengguna
    Route::get('/user', fn(Request $request) => $request->user());
    Route::apiResource('/orders', OrderController::class)->only(['index', 'show', 'store']);
    Route::apiResource('/payment_methods', PaymentMethodController::class)->only(['show']);
    Route::apiResource('/books', BookController::class)->only(['store']);


    // Routes untuk admin dan staff
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::apiResource('/books', BookController::class)->only([ 'update', 'destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'update', 'destroy']);

        Route::apiResource('/orders', OrderController::class)->only(['update', 'destroy']);
        Route::apiResource('/payments', PaymentController::class)->only(['update', 'destroy']);
        Route::apiResource('/payment_methods', PaymentMethodController::class)->only(['store', 'update', 'destroy']);

    });

    // Routes untuk customer
    Route::middleware(['role:customer'])->group(function () {
        Route::apiResource('/orders', OrderController::class)->only(['index', 'store', 'show']);
        Route::apiResource('/orderdetails', OrderDetailController::class)->only(['index', 'store', 'show']);
        Route::apiResource('/payments', PaymentController::class)->only(['store']);
    });
});

// Routes publik (tanpa autentikasi)



