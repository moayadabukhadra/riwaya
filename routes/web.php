
<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

/* books */
Route::name('book.')->group(function (){
   Route::get('/books',[BookController::class,'index'])->name('index');
   Route::prefix('book')->group(function (){
       Route::get('/show/{book?}',[BookController::class,'show'])->name('show');
         Route::post('/store/{book?}',[BookController::class,'store'])->name('store');
   });
});

/* authors */
Route::name('author.')->group(function (){
    Route::get('/authors',[AuthorController::class,'index'])->name('index');
    Route::prefix('author')->group(function (){
        Route::get('/show/{author?}',[AuthorController::class,'show'])->name('show');
        Route::post('/store/{author?}',[AuthorController::class,'store'])->name('store');
    });
});

/* categories */
Route::name('category.')->group(function (){
    Route::get('/categories',[CategoryController::class,'index'])->name('index');
    Route::prefix('category')->group(function (){
        Route::get('/show/{category?}',[CategoryController::class,'show'])->name('show');
        Route::post('/store/{category?}',[CategoryController::class,'store'])->name('store');
    });
});
