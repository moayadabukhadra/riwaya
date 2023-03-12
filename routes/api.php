<?php

use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Books*/
Route::group(['name' => 'book'], function () {
    Route::get('books', [BookController::class, 'index'])->name('index');
    Route::prefix('book')->group(function () {
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/show/{book}', [BookController::class, 'show'])->name('show');
        Route::post('/update/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('destroy');
    });
});

/* AUTHORS */
Route::group(['name' => 'author'], function () {
    Route::get('authors', [AuthorController::class, 'index'])->name('index');
    Route::prefix('author')->group(function () {
        Route::post('/', [AuthorController::class, 'store'])->name('store');
        Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
        Route::post('/{author}', [AuthorController::class, 'update'])->name('update');
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
    });
});

/* CATEGORIES */
Route::group(['name' => 'category'], function () {
    Route::get('categories', [CategoryController::class, 'index'])->name('index');
    Route::prefix('category')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::post('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('user-role', [UserController::class, 'userRole']);
});
