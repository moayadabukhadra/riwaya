<?php

use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BookMarkController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\QuoteController;
use App\Http\Controllers\api\SocialController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
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
    Route::get('books/all',[BookController::class,'getBooksWithoutPagination'])->name('all-books');
    Route::prefix('book')->group(function () {
        Route::get('/latest', [BookController::class, 'latest'])->name('latest');
        Route::get('/most-read', [BookController::class, 'mostRead'])->name('most-read');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/show/{book}', [BookController::class, 'show'])->name('show');
        Route::put('/update/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('destroy');
        Route::get('/download/{book}', [BookController::class, 'downloadPdf'])->name('download');
    });
});

/* AUTHORS */
Route::group(['name' => 'author'], function () {
    Route::get('authors', [AuthorController::class, 'index'])->name('index');
    Route::prefix('author')->group(function () {
        Route::post('/', [AuthorController::class, 'store'])->name('store');
        Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
        Route::put('/{author}', [AuthorController::class, 'update'])->name('update');
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
        Route::get('/{author}/books', [AuthorController::class, 'books'])->name('books');
    });
});

/* CATEGORIES */
Route::group(['name' => 'category'], function () {
    Route::get('categories', [CategoryController::class, 'index'])->name('index');
    Route::prefix('category')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:api', 'name' => 'user.'], function () {
    Route::post('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::post('/edit-profile-image', [UserController::class, 'editProfileImage'])->name('edit-profile-image');
    Route::get('/my-library', [UserController::class, 'userBooks'])->name('my-library');
    Route::get('check-library-for-book/{book}', [UserController::class, 'checkBook'])->name('check-book');
    Route::post('update-library/{book}', [UserController::class, 'updateLibrary'])->name('update-library');
});

/* comments */
Route::group(['name' => 'comment'], function () {
    Route::post('comment/add/{book}', [CommentController::class, 'store'])->name('store');
});

/* socialite */
Route::post('auth/facebook', [SocialController::class, 'loginWithFacebook']);
Route::post('auth/google', [SocialController::class, 'loginWithGoogle']);


/* QUOTES */
Route::group(['name' => 'quote'], function () {
    Route::get('quotes', [QuoteController::class, 'index'])->name('index');

    Route::prefix('quote')->group(function () {
        Route::get('/random', [QuoteController::class, 'getRandomQuote'])->name('random');
        Route::get('/{quote}', [QuoteController::class, 'show'])->name('show');
    });
});

/* Search */
Route::get('/search', [HomeController::class, 'search'])->name('search');

/*Bookmarks*/
Route::group(['name' => 'bookmark', 'middleware' => 'auth:api'], function () {
    Route::get('bookmarks', [BookMarkController::class, 'index'])->name('index');
    Route::prefix('bookmark')->group(function () {
        Route::get('favorite', [BookMarkController::class, 'favoriteBooks'])->name('favorite');
        Route::get('to-read-later', [BookMarkController::class, 'toReadLaterBooks'])->name('to-read-later');
        Route::get('done-reading', [BookMarkController::class, 'doneReadingBooks'])->name('done-reading');
        Route::get('status/{book}', [BookMarkController::class, 'checkBookmarkStatus'])->name('status');

        Route::post('store/{book}/{bookmark_type}', [BookMarkController::class, 'store'])->name('store');
    });
});

/* messages */
Route::group(['name' => 'message'], function () {
    Route::post('message/send', [MessageController::class, 'store'])->name('send');
});

Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('auth/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
