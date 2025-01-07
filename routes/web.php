<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppleMusicController;

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

// login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('auth/apple', [LoginController::class, 'redirectToApple'])->name('login.apple');
Route::get('auth/apple/callback', [LoginController::class, 'handleAppleCallback']);


Route::get('/auth/apple-music', [AppleMusicController::class, 'redirectToAppleMusic']);
Route::post('/auth/apple-music/callback', [AppleMusicController::class, 'handleAppleMusicCallback']);



Route::get('/apple-music/artist/{id}', [AppleMusicController::class, 'getArtistDetails']);
