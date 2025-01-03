<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppleAuthController;
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
})->name('home');

Route::get('/search-artist', [AppleMusicController::class, 'searchArtist']);

// Route::get('/artist/{artistId}', [AppleMusicController::class, 'showArtist']);
Route::get('/artist/{id}', [AppleMusicController::class, 'getArtistById']);

// Route::get('/apple-login', function () {
//     return view('auth.apple-login');
// })->name('login');


Route::get('/login/apple', [AppleAuthController::class, 'redirectToApple'])->name('login.apple');
Route::get('/login/apple/callback', [AppleAuthController::class, 'handleAppleCallback'])->name('login.apple.callback');


route::get('/album', [AppleMusicController::class, 'getAlbums']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
