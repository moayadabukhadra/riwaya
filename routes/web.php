<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\LoginRegister;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin
Route::get('create-book',[BookController::class, 'createBook'])->middleware('admin');
Route::post('create-book',[BookController::class,'store'])->middleware('admin');
Route::patch('orders',[OrderController::class,'update'])->middleware('admin');
Route::view('orders','components.admin')->name('orders')->middleware('admin');
Route::name('category.')->group(function (){

    Route::get('categories',[CategoryController::class,'index'])->name('index')->middleware('admin');

});


//guest
Route::view('login-register','components.login-register')->middleware('guest');


//auth
Route::view('shopping-cart','components.cart')->middleware('auth');
Route::view('check-out','components.checkout')->middleware('auth');
Route::post('check-out',[OrderController::class,'store'])->middleware('auth');
Route::get('logout',[LoginRegister::class,'logout'])->middleware('auth');
Route::view('track-order','components.user-orders')->middleware('auth');

// Orders
Route::post('/edit-order/{order}',[OrderController::class,'edit'])->name('edit.order');


Route::view('/','livewire.home');
Route::view('dashboard','livewire.dashboard');




