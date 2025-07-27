<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  AccidentReportingController,
  ActivityNotificationController, 
  AuthController,
  FirstAidController,
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
  
  if(config('app.debug')) {
    Route::get('/view/{id}', 'view');
    Route::get('/resend/{id}', 'resend');
  }
});

Route::controller(FirstAidController::class)->prefix('/first-aid')->group(function () {
  Route::get('/', 'index')->name('fa.form');
  Route::post('/submit', 'submit')->name('fa.submit');

  if(config('app.debug')) {
    Route::get('/view/{id}', 'view');
    Route::get('/resend/{id}', 'resend');
  }
});

Route::controller(AccidentReportingController::class)->prefix('/accident-report')->group(function () {
  Route::get('/', 'index')->name('accident.form');
  Route::post('/submit', 'submit')->name('accident.submit');

  if(config('app.debug')) {
    Route::get('/view/{id}', 'view');
    Route::get('/resend/{id}', 'resend');
  }
});