<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  ActivityNotificationController, 
  AuthController,
  FirstAidRecordingController,
  RootController,
};

// Route::controller(AuthController::class)->group(function () {
//   Route::get('/login', 'login')->name('auth.login');
//   Route::get('/login/redirect', 'oauthRedirect')->name('auth.oauth.redirect');
//   Route::get('/login/return', 'oauthReturn')->name('auth.oauth.return');
//   Route::get('/logout', 'logout')->name('auth.logout');
// });

Route::controller(RootController::class)->group(function () {
  Route::get('/', 'index')->name('root');
});

Route::controller(ActivityNotificationController::class)->prefix('/activity-notification')->group(function () {
  Route::get('/', 'index')->name('notification.form');
  Route::post('/submit', 'submit')->name('notification.submit');
  Route::get('/demo/{id}', 'demo');
});


Route::controller(FirstAidRecordingController::class)->prefix('/first-aid')->group(function () {
  Route::get('/', 'index')->name('firstaid.form');
  Route::post('/submit', 'submit')->name('firstaid.submit');
});