<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  ActivityNotificationController, 
  AuthController,
  ExternalFirstAidController,
  InternalFirstAidController,
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


Route::prefix('/first-aid')->group(function () {
  Route::get('/internal', [InternalFirstAidController::class, 'index'])->name('fa.internal.form');
  Route::post('/internal/submit', [InternalFirstAidController::class, 'submit'])->name('fa.internal.submit');
  Route::get('/external', [ExternalFirstAidController::class, 'index'])->name('fa.external.form');
  Route::post('/external/submit', [ExternalFirstAidController::class, 'submit'])->name('fa.external.submit');
});