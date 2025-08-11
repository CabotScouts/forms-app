<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Mail\AccidentReportSubmitted;
use App\Models\AccidentReport;

class AccidentReportingController
{
  public function index(): View
  {
    return view('accident-report.form');
  }

  public function submit(Request $request): View
  {
    $rules = [
      'reporter_name' => ['required', 'max:255'],
      'reporter_email' => ['required', 'email', 'max:255'],
      'reporting_unit' => ['required', 'max:255'],
      'their_name' => ['required', 'max:255'],
      'their_dob' => ['required', 'date', Rule::date()->beforeOrEqual(today())],
      'their_unit' => ['nullable', 'max:255'],
      'when' => ['required', 'date', Rule::date()->beforeOrEqual(today())],
      'where' => ['required', 'max:255'],
      'details' => ['required'],
      'treatment' => ['nullable'],
      'further_reporting' => ['nullable', 'boolean'],
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'reporter_name' => 'reporter\'s name',
      'reporter_email' => 'reporter\'s email address',
      'reporting_unit' => 'reporting unit',
      'their_name' => 'their name',
      'their_dob' => 'their date of birth',
      'their_unit' => 'their Scouting unit',
      'when' => 'when',
      'where' => 'where',
      'details' => 'accident information',
      'treatment' => 'treatment information',
      'further_reporting' => 'further reporting',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $report = AccidentReport::create($validated);
    $report->send();

    return view('accident-report.post-submission', ['report' => $report]);
  }

  public function view($id): View
  {
    $n = AccidentReport::findOrFail($id);
    return view('accident-report.post-submission', ['report' => $n]);
  }

  public function resend($id)
  {
    $n = AccidentReport::findOrFail($id);
    $n->send();

    session()->flash('alert', [
      'success' => 'Accident report has been resent.'
    ]);

    return redirect()->route('root');
  }
}
