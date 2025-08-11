<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Mail\NotificationSubmitted;
use App\Models\Notification;

class ActivityNotificationController
{
  public function index(): View
  {
    return view('activity-notification.form', ['form' => false]);
  }

  public function submit(Request $request): View
  {
    $rules = [
      'lic_name' => ['required', 'max:255'],
      'lic_email' => ['required', 'email', 'max:255'],
      'lic_phone' => ['required', 'max:255'],
      'submitter_name' => ['nullable', 'required_with:submitter_email', 'max:255'],
      'submitter_email' => ['nullable', 'email', 'required_with:submitter_name', 'max:255'],
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
      'uploads' => ['required'],
      'intouch' => ['required'],
      'team_leader_email' => ['required', 'email'],
      'h-captcha-response' => ['required', 'hcaptcha'],
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
      'uploads' => 'risk assessments',
      'intouch' => 'inTouch arrangements',
      'team_leader_email' => 'GLV/Team Leader email address',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $notification = Notification::create($validated);
    $notification->processUploads($validated["uploads"]);
    $notification->send();

    return view('activity-notification.post-submission', ['notification' => $notification]);
  }

  public function view($id): View
  {
    $n = Notification::findOrFail($id);
    return view('activity-notification.post-submission', ['notification' => $n]);
  }

  public function resend($id): RedirectResponse
  {
    $n = Notification::findOrFail($id);
    $n->send();

    session()->flash('alert', [
      'success' => 'Activity notification has been resent.'
    ]);

    return redirect()->route('root');
  }
}
