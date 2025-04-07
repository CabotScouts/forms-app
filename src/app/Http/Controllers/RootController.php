<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RootController
{
  public function index()
  {
    return view('notification', ["form" => false]);
  }

  public function submit(Request $request)
  {
    $rules = [
      'lic-name' => ['required', 'max:255'],
      'lic-email' => ['required', 'email', 'max:255'],
      'lic-phone' => ['required', 'max:255'],
      'submitter-name' => ['nullable', 'max:255'],
      'submitter-email' => ['nullable', 'email'],
      'group' => ['required', 'max:255'],
      'section' => ['required', 'max:255'],
      'number-squirrels' => ['nullable', 'gte:0'],
      'number-beavers' => ['nullable', 'gte:0'],
      'number-cubs' => ['nullable', 'gte:0'],
      'number-scouts' => ['nullable', 'gte:0'],
      'number-explorers' => ['nullable', 'gte:0'],
      'number-adults' => ['nullable', 'gte:0'],
      'date' => ['required', 'date'],
      'location' => ['required'],
      'description' => ['required'],
      'activity-leader' => ['nullable', 'max:255'],
      'activity-leader-email' => ['nullable', 'email', 'max:255'],
      'risk-assessments' => ['required'],
      'intouch' => ['required'],
      'team-leader-email' => ['required', 'email'],
      'h-captcha-response' => ['hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'lic-name' => 'Leader in Charge\'s name',
      'lic-email' => 'Leader in Charge\'s email address',
      'lic-phone' => 'Leader in Charge\'s phone number',
      'submitter-name' => 'notification submitter\'s name',
      'submitter-email' => 'notification submitter\'s email address',
      'group' => 'Group',
      'section' => 'Section',
      'number-squirrels' => 'number of Squirrels',
      'number-beavers' => 'number of Beavers',
      'number-cubs' => 'number of Cubs',
      'number-scouts' => 'number of Scouts',
      'number-explorers' => 'number of Exporers',
      'number-adults' => 'number of Adults',
      'date' => 'activity date',
      'location' => 'activity location',
      'description' => 'activity details',
      'activity-leader' => 'permit holder/activity leader details',
      'activity-leader-email' => 'permit holder/activity leader email address',
      'risk-assessments' => 'risk assessments',
      'intouch' => 'inTouch arrangements',
      'team-leader-email' => 'GLV/Team Leader email address',
    ];

    $validator = Validator::make($request->all(), $rules, $messages, $names)->validate();

    return $request->all();
  }
}
