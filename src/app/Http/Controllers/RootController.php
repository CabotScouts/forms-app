<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RootController
{
  public function index()
  {
    return view('notification', ["form" => false]);
  }

  public function submit(Request $request)
  {
    $validated = $request->validate([
      'lic-name' => ['required', 'max:255'],
      'lic-email' => ['required', 'email'],
      'lic-phone' => ['required'],

      'submitter-name' => [],
      'submitter-email' => ['nullable', 'email'],

      'group' => ['required'],
      'section' => ['required'],

      'number-squirrels' => ['nullable', 'gte:0'],
      'number-beavers' => ['nullable', 'gte:0'],
      'number-cubs' => ['nullable', 'gte:0'],
      'number-scouts' => ['nullable', 'gte:0'],
      'number-explorers' => ['nullable', 'gte:0'],
      'number-adults' => ['nullable', 'gte:0'],

      'date' => ['required', 'date'],
      'location' => ['required'],
      'description' => ['required'],

      'activity-leader' => [],
      'activity-leader-email' => ['nullable', 'email'],

      'risk-assessments' => [],

      'intouch' => ['required'],

      'team-leader-email' => ['required', 'email'],

      'h-captcha-response' => ['hcaptcha'],
    ]);

    return $request->all();
  }
}
