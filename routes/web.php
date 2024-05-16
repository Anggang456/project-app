<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
})->middleware('guest');

Auth::routes();
Route::post('/booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('app.booking');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('app.home');
Route::get('/approve/{id}', [App\Http\Controllers\HomeController::class, 'approve'])->name('app.approve');
Route::get('/reject/{id}', [App\Http\Controllers\HomeController::class, 'reject'])->name('app.reject');




