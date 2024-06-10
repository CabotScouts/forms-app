<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController
{
  public function NAN(Request $request)
  {
    if($request->query('i') && $request->query('r'))
    {
      // fetch existing NAN submission (if it exists)
      // check it isn't locked
      $form = false;
      return view('nan-form', ['form' => $form]);
    }

    return view('nan-form', ['form' => false]);
  }

  public function processNAN(Request $request)
  {
    // return $request->all();
    
  }

  public function AAN()
  {
    return view('aan-form');
  }
}
