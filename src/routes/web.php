<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RootController;

// Route::controller(AuthController::class)->group(function () {
//   Route::get('/login', 'login')->name('auth.login');
//   Route::get('/login/redirect', 'oauthRedirect')->name('auth.oauth.redirect');
//   Route::get('/login/return', 'oauthReturn')->name('auth.oauth.return');
//   Route::get('/logout', 'logout')->name('auth.logout');
// });

Route::controller(RootController::class)->group(function () {
  Route::get('/', 'index')->name('root.index');
  Route::post('/submit', 'submit')->name('root.submit');
});
