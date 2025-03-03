<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController
{
  public function index()
  {
    return view('index');
  }

  public function guidance()
  {
    return view('index');
  }

  public function submit(Request $request)
  {
    return $request->all();
  }
}
