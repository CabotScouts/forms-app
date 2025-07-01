<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage, Validator};

use App\Mail\NotificationSubmitted;
use App\Models\FirstAidValidation;

class InternalFirstAidController
{
  public function index()
  {
    return view('firstaid.internal', ["form" => false]);
  }

  public function submit(Request $request)
  {
    $rules = [
      'name' => ['required', 'max:255'],
      'email' => ['required', 'email', 'max:255'],
      'membership' => ['required', 'numeric', 'max:255'],
      'uploads' => ['required'],
      'additional' => ['text'],
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'name' => 'Volunteers\'s name',
      'email' => 'Volunteer\'s email address',
      'membership' => 'Volunteer\'s membership number',
      'additional' => "additional information",
      'uploads' => 'evidence',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $submission = FirstAidValidation::create($validated);
    $submission->type = 'internal';
    $submission->processUploads($validated["uploads"]);
    // $submission->send();

    session()->flash('alert', [
      'success' => 'Your internal qualification has been submitted.'
    ]);

    return redirect()->route("root");
  }

}
