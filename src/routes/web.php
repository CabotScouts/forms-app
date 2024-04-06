<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'login')->name('auth.login');
  Route::get('/login/redirect', 'oauthRedirect')->name('auth.oauth.redirect');
  Route::get('/login/return', 'oauthReturn')->name('auth.oauth.return');
  Route::get('/logout', 'logout')->name('auth.logout');
});

Route::controller(ApprovalsController::class)->prefix('approvals')->group(function () {
  // List all notifications requiring approval (with filter to view all)
  Route::get('/{filter?}', 'list')->name('approvals.list');

  // View an individual NAN and submit approval/comments
  Route::get('/nan/{id}/view', 'viewNAN')->name('approvals.nan.view');
  Route::post('/nan/{id}/update', 'updateNAN')->name('approvals.nan.update');

  // View an individual AAN and submit approval/comments
  Route::get('/aan/{id}/view', 'viewAAN')->name('approvals.aan.view');
  Route::post('/aan/{id}/update', 'updateAAN')->name('approvals.aan.update');

  // View list of contacts (who receive submitted NANs)
  Route::get('/contacts', 'viewContacts')->name('approvals.contacts.view');
  Route::post('/contacts/add', 'addContact')->name('approvals.contacts.add');
  Route::post('/contacts/update', 'updateContacts')->name('approvals.contacts.update');
});

Route::controller(FormController::class)->group(function () {
  // NAN form - info, form, submission, and return to submission-in-progress
  Route::get('/nan', 'NAN')->name('nan');
  Route::post('/nan', 'processNAN');

  // AAN form - info, form, submission, and return to submission-in-progress
  Route::get('/aan', 'AAN')->name('aan');
  Route::post('/aan', 'processAAN');
});

Route::controller(RootController::class)->group(function () {
  Route::get('/', 'index')->name('root.index');
  Route::get('/help', 'help')->name('root.help');
});

Route::controller(UserController::class)->prefix('users')->group(function () {
  Route::get('/', 'list')->name('users.list');
  Route::post('/update', 'update')->name('users.update');
});