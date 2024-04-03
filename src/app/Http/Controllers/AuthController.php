<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController
{
  public function login()
  {
    return view('login');
  }

  public function oauthRedirect(Request $request)
  {
    try
    {
      $state = Str::random(32);
      session(['oauth_state' => $state]);

      $client = new \Google\Client();
      $client->setClientId(config('oauth.id'));
      $client->setClientSecret(config('oauth.secret'));
      $client->setScopes([
        "openid",
        "https://www.googleapis.com/auth/userinfo.email",
      ]);
      $client->setState($state);
      $client->setRedirectUri(route('auth.oauth.return'));
      $client->setAccessType('offline');
      $url = $client->createAuthUrl();

      return redirect($url);
    }

    catch(Google\Service\Exception $e)
    {
      // flash error message
      return redirect('auth.login');
    }
  }

  public function oauthReturn(Request $request)
  {
    if($request->query('error', false))
    {
      $request->session()->flash('error', "Login failed (" . $request->query('error') . ")");
      return redirect()->route('auth.login');
    }
    elseif($request->query('code', false))
    {
      $session_state = session('state', false);
      $returned_state = $request->query('state', false);
      if($returned_state !== false && $session_state !== false && $returned_state === $session_state)
      {
        try
        {
          $client = new \Google\Client();
          $client->setClientId(config('oauth.id'));
          $client->setClientSecret(config('oauth.secret'));
        }

        catch(Google\Service\Exception $e)
        {
          // flash error message
          return redirect('auth.login');
        }
      }
      else
      {
        // flash an error message
        return redirect()->route('auth.login');
      }
    }
  }

  public function logout()
  {
    return redirect()->route('root.index');
  }

}
