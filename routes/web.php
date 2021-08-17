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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('order', \App\Http\Controllers\OrderController::class);
    Route::resource('payment', \App\Http\Controllers\PaymentController::class);
    Route::resource('setting', \App\Http\Controllers\SettingController::class);
    Route::get('/search/order', [App\Http\Controllers\OrderController::class, 'search'])->name('orders.search');
    Route::get('/export/order', [App\Http\Controllers\OrderController::class, 'export'])->name('export.order');
    Route::post('/location/order/{id}', [App\Http\Controllers\OrderController::class, 'location'])->name('location.order');
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('/generate/agreement/{id}', [\App\Http\Controllers\OrderController::class, 'agreement'])->name('generate.agreement');
});

Route::post('/online/order', [App\Http\Controllers\OrderController::class, 'online'])->name('online.order');





