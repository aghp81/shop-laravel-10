<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GoogleSocialiteController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// login with Google Acount
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleSocialiteController@redirectToGoogle');
Route::get('callback/google', 'App\Http\Controllers\Auth\GoogleSocialiteController@handleCallback');


// otp mobile number
Route::controller(App\Http\Controllers\AuthOtpController::class)->group(function () {
    Route::get('/otp/login', 'App\Http\Controllers\AuthOtpController@login')->name('otp.login');
Route::post('/otp/generate', 'App\Http\Controllers\AuthOtpController@generate')->name('otp.generate');
});
