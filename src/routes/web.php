<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
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
  Route::get('/internal', 'internal')->name('fa.internal.form');
  Route::post('/internal/submit', 'submitInternal')->name('fa.internal.submit');
  Route::get('/external', 'external')->name('fa.external.form');
  Route::post('/external/submit', 'submitExternal')->name('fa.external.submit');

  if(config('app.debug')) {
    Route::get('/view/{id}', 'view');
    Route::get('/resend/{id}', 'resend');
  }
});