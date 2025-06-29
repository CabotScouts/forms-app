<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage, Validator};

use App\Mail\NotificationSubmitted;
use App\Models\{Notification, Upload};

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
      'membership' => ['required', 'number', 'max:255'],
      'uploads' => ['required'],
      'additional_information' => ['text'],
      'h-captcha-response' => ['required', 'hcaptcha'],
    ];

    $messages = [
      'hcaptcha' => 'You need to confirm you\'re a human',
    ];

    $names = [
      'name' => 'Volunteers\'s name',
      'email' => 'Volunteer\'s email address',
      'membership' => 'Volunteer\'s membership number',
      'additional_information' => "additional information",
      'uploads' => 'evidence',
    ];

    $validated = Validator::make($request->all(), $rules, $messages, $names)->validate();
    $notification = Notification::create($validated);

    $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
    $submitted = json_decode($validated["uploads"]);
    
    $uploads = [];
    foreach($submitted as $sid) {
      $temppath = $filepond->getPathFromServerId($sid);
      if(Storage::exists($temppath)) {
        $file = basename($temppath);
        $path = sprintf("uploads/%s_%s", $notification->id, $file);
        $fullpath = sprintf("public/%s", $path);
        Storage::move($temppath, $fullpath);

        $u = new Upload;
        $u->name = $file;
        $u->path = $path;
        $uploads[] = $u;
      }
    }
    $notification->uploads()->saveMany($uploads);
    $notification->send();

    session()->flash('alert', [
      'success' => 'Your internal qualification has been submitted.'
    ]);


    return redirect()->route("root");
  }

}
