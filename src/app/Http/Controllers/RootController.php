<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController
{
  public function index()
  {
    return view('notification');
  }

  public function submit(Request $request)
  {
    return $request->all();
  }
}
