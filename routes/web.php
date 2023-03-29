<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* admin permissions */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::name('book.')->group(function () {
        Route::get('/books', [BookController::class, 'index'])->name('index');
        Route::prefix('book')->group(function () {
            Route::get('/show/{book?}', [BookController::class, 'show'])->name('show');
            Route::post('/store/{book?}', [BookController::class, 'store'])->name('store');
        });
    });

    /* authors */
    Route::name('author.')->group(function () {
        Route::get('/authors', [AuthorController::class, 'index'])->name('index');
        Route::prefix('author')->group(function () {
            Route::get('/show/{author?}', [AuthorController::class, 'show'])->name('show');
            Route::post('/store/{author?}', [AuthorController::class, 'store'])->name('store');
        });
    });

    /* categories */
    Route::name('category.')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('index');
        Route::prefix('category')->group(function () {
            Route::get('/show/{category?}', [CategoryController::class, 'show'])->name('show');
            Route::post('/store/{category?}', [CategoryController::class, 'store'])->name('store');
        });
    });

    /* Users */
    Route::name('user.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('index');
        Route::prefix('user')->group(function () {
            Route::get('/show/{user?}', [UserController::class, 'show'])->name('show');
            Route::post('/store/{user?}', [UserController::class, 'store'])->name('store');
        });
    });

    /* Quotes */
    Route::name('quote.')->group(function () {
        Route::get('/quotes', [QuoteController::class, 'index'])->name('index');
        Route::prefix('quote')->group(function () {
            Route::get('/show/{quote?}', [QuoteController::class, 'show'])->name('show');
            Route::post('/store/{quote?}', [QuoteController::class, 'store'])->name('store');
        });
    });
});

/* auth */
Route::middleware('guest')->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('show-login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('show-register');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
