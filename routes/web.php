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
Route::get('auth/facebook', [App\Http\Controllers\Auth\LoginController::class,'redirectToFacebook']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\LoginController::class,'handleFacebookCallback']);
Route::post('auth/fetch-states', [App\Http\Controllers\Auth\RegisterController::class, 'fetchState']);
Route::post('auth/fetch-cities', [App\Http\Controllers\Auth\RegisterController::class, 'fetchCity']);
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changePassword');
Route::post('/statusUpdate', [App\Http\Controllers\HomeController::class, 'statusUpdate'])->name('statusUpdate');
Route::post('/changeStatus', [App\Http\Controllers\HomeController::class, 'changeStatus'])->name('changeStatus');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');