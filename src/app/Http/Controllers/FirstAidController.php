<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Mail\FirstAidValidationSubmitted;
use App\Models\FirstAidValidation;

class FirstAidController
{
  public function index(): View
  {
    return view('first-aid.form', ["form" => false]);
  }

  public function submit(Request $request): View
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
      'additional' => "additional information",
      'uploads' => 'evidence',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $submission = FirstAidValidation::create($validated);
    $submission->processUploads($validated["uploads"]);
    $submission->send();

    return view('first-aid.post-submission');
  }

  public function view($id): FirstAidValidationSubmitted
  {
    $v = FirstAidValidation::findOrFail($id);
    return new FirstAidValidationSubmitted($v);
  }

  public function mail($id): FirstAidValidationSubmitted
  {
    $v = FirstAidValidation::findOrFail($id);
    return new FirstAidValidationSubmitted($v);
  }

  public function resend($id): RedirectResponse
  {
    $v = FirstAidValidation::findOrFail($id);
    $v->send();

    session()->flash('alert', [
      'success' => 'First Aid validation has been resent.'
    ]);

    return redirect()->route('root');
  }
}
