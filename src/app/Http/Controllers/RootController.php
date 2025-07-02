<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class RootController
{
  public function index(): View
  {
    return view('index');
  }

}
