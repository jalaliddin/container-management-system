<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('order', \App\Http\Controllers\OrderController::class)->middleware('auth');
Route::resource('payment', \App\Http\Controllers\PaymentController::class)->middleware('auth');
Route::resource('setting', \App\Http\Controllers\SettingController::class);
//Route::resource('order', 'OrderController', ['names' => [
//    'index' => 'order'
//]]);


