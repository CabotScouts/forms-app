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
      'h-captcha-response' => ['hcaptcha'],
    ]);

    return $request->all();
  }
}
