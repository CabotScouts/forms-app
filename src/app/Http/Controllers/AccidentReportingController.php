<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Mail\AccidentReportSubmitted;
use App\Models\AccidentReport;

class ActivityNotificationController
{
  public function index()
  {
    return view('accident-report', ["form" => false]);
  }

  public function submit(Request $request)
  {
    $rules = [
      
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();

    $notification = AccidentReport::create($validated);
    $notification->send();

    session()->flash('alert', [
      'success' => 'Your accident report has been submitted.'
    ]);

    return redirect()->route("root");
  }

  public function view($id)
  {
    $n = AccidentReport::findOrFail($id);
    return new AccidentReportSubmitted($n);
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
