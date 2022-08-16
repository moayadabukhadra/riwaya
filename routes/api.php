<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// protected routes for authenticated users
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
});

// public routes for unauthenticated users
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/books/search/{name}', [BookController::class, 'search']);
Route::get('/books', [BookController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);








Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
