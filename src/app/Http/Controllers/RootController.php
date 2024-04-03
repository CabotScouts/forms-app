<?php

namespace App\Http\Controllers;

class RootController
{
  public function index()
  {
    return view('index');
  }

  public function help()
  {
    return view('help');
  }
}
