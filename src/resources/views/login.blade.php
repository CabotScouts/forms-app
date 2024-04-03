<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('static/css/scoutstrap.min.css') }}">
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,400;1,600&display=swap"
    rel="stylesheet">

  <title>Login - {{ config('scout.district') }} Scout District</title>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
      <div class="col-12 col-lg-9 text-center mb-5">
        <div class="logo-inline-white logo-inline-w200 mt-4 mb-2">
          <h6>{{ config('scout.district') }}</h6>
        </div>
        <div class="bg-light m-4 p-4">
          <h3 class="py-2">District Sign In</h3>
          <p>
            This login page is intended for the District Team and other designated members to sign in to view and manage
            submitted notifications.
          </p>
          <p>
            <strong>
              You do not need to login to submit a notification.
            </strong>
          </p>
          <p>
            To submit a notification please <a href="{{ route('root.index') }}">return to the front page</a>.
          </p>
          <p>
            <a href="{{ route('auth.oauth.redirect') }}" class="btn btn-primary btn-lg mt-2">Sign in with
              Google</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
</body>

</html>
