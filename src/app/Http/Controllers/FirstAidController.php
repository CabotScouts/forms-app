<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage, Validator};
use Illuminate\Validation\Rule;

use App\Mail\NotificationSubmitted;
use App\Models\FirstAidValidation;

class FirstAidController
{
  public function internal()
  {
    return view('firstaid.internal', ["form" => false]);
  }

  public function submitInternal(Request $request)
  {
    $rules = [
      'name' => ['required', 'max:255'],
      'email' => ['required', 'email', 'max:255'],
      'membership' => ['required', 'numeric', 'gt:0'],
      'uploads' => ['required'],
      'date' => [
        'required',
        'date',
        Rule::date()->beforeOrEqual(today()),
        Rule::date()->after(today()->subYears(3)),
      ],
      'additional' => ['string', 'nullable'],
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'name' => 'Volunteers\'s name',
      'email' => 'Volunteer\'s email address',
      'membership' => 'Volunteer\'s membership number',
      'date' => 'course date',
      'additional' => "First Response trainer information",
      'uploads' => 'evidence',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $submission = FirstAidValidation::create($validated);
    $submission->type = 'internal';
    $submission->processUploads($validated["uploads"]);
    $submission->save();
    $submission->send();

    session()->flash('alert', [
      'success' => 'Your internal qualification has been submitted.'
    ]);

    return redirect()->route("root");
  }

  public function external()
  {
    return view('firstaid.external', ["form" => false]);
  }

    public function submitExternal(Request $request)
  {
    $rules = [
      'name' => ['required', 'max:255'],
      'email' => ['required', 'email', 'max:255'],
      'membership' => ['required', 'numeric', 'gt:0'],
      'uploads' => ['required'],
      'date' => [
        'required',
        'date',
        Rule::date()->beforeOrEqual(today()),
        Rule::date()->after(today()->subYears(3)),
      ],
      'additional' => ['string', 'nullable'],
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'name' => 'Volunteers\'s name',
      'email' => 'Volunteer\'s email address',
      'membership' => 'Volunteer\'s membership number',
      'date' => 'course date',
      'additional' => "Authorising Organisation information",
      'uploads' => 'evidence',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $submission = FirstAidValidation::create($validated);
    $submission->type = 'external';
    $submission->processUploads($validated["uploads"]);
    $submission->save();
    $submission->send();

    session()->flash('alert', [
      'success' => 'Your external qualification has been submitted.'
    ]);

    return redirect()->route("root");
  }

}
