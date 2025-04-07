<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Notification;

class RootController
{
  public function index()
  {
    return view('notification', ["form" => false]);
  }

  public function submit(Request $request): RedirectResponse
  {
    $rules = [
      'lic_name' => ['required', 'max:255'],
      'lic_email' => ['required', 'email', 'max:255'],
      'lic_phone' => ['required', 'max:255'],
      'submitter_name' => ['nullable', 'max:255'],
      'submitter_email' => ['nullable', 'email'],
      'group' => ['required', 'max:255'],
      'section' => ['required', 'max:255'],
      'number_squirrels' => ['nullable', 'gte:0'],
      'number_beavers' => ['nullable', 'gte:0'],
      'number_cubs' => ['nullable', 'gte:0'],
      'number_scouts' => ['nullable', 'gte:0'],
      'number_explorers' => ['nullable', 'gte:0'],
      'number_adults' => ['nullable', 'gte:0'],
      'date' => ['required', 'date'],
      'location' => ['required'],
      'description' => ['required'],
      'activity_leader' => ['nullable', 'max:255'],
      'activity_leader_email' => ['nullable', 'email', 'max:255'],
      'risk_assessments' => ['required'],
      'intouch' => ['required'],
      'team_leader_email' => ['required', 'email'],
      'h-captcha-response' => ['hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'lic_name' => 'Leader in Charge\'s name',
      'lic_email' => 'Leader in Charge\'s email address',
      'lic_phone' => 'Leader in Charge\'s phone number',
      'submitter_name' => 'notification submitter\'s name',
      'submitter_email' => 'notification submitter\'s email address',
      'group' => 'Group',
      'section' => 'Section',
      'number_squirrels' => 'number of Squirrels',
      'number_beavers' => 'number of Beavers',
      'number_cubs' => 'number of Cubs',
      'number_scouts' => 'number of Scouts',
      'number_explorers' => 'number of Explorers',
      'number_adults' => 'number of Adults',
      'date' => 'activity date',
      'location' => 'activity location',
      'description' => 'activity details',
      'activity_leader' => 'permit holder/activity leader details',
      'activity_leader_email' => 'permit holder/activity leader email address',
      'risk_assessments' => 'risk assessments',
      'intouch' => 'inTouch arrangements',
      'team_leader_email' => 'GLV/Team Leader email address',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $notification = Notification::create($validated);

    session()->flash('alert', [
      'success' => 'Your activity notification has been submitted.'
    ]);

    return redirect()->route("root.index");
  }
}
