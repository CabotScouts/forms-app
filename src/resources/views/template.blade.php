<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('static/scoutstrap.min.css') }}">
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,400;1,600&display=swap"
    rel="stylesheet">
  @stack('head-additional')

  <title>@yield('title', 'Notify') - {{ config('scout.district') }} Scout District</title>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-lg">
      <a class="navbar-brand" href="{{ route('root.index') }}"><svg class="svg-icon icon-med icon-white"
          viewBox="0 0 20 20">
          <path
            d="M5.38,9.11a6.13,6.13,0,0,1,.91,2.43h1a7,7,0,0,0-1.07-3,3.6,3.6,0,0,0-3-1.86h0A2.93,2.93,0,0,0,.91,7.81,3,3,0,0,0,.3,10.39l1-.21a2.1,2.1,0,0,1,.42-1.76A1.92,1.92,0,0,1,3.2,7.7h0A2.73,2.73,0,0,1,5.38,9.11Z">
          </path>
          <path
            d="M12.57,16a4.71,4.71,0,0,1-.79-1.78h-1a5.55,5.55,0,0,0,.82,2.1A4.18,4.18,0,0,1,10,17.77h0a4.17,4.17,0,0,1-1.59-1.45,5.55,5.55,0,0,0,.82-2.1h-1A4.71,4.71,0,0,1,7.44,16l-.17.23.12.26A5,5,0,0,0,9.8,18.77l.2.09h0l.2-.09a5,5,0,0,0,2.41-2.27l.12-.26Z">
          </path>
          <path
            d="M14.62,9.11a6.13,6.13,0,0,0-.91,2.43h-1a7,7,0,0,1,1.07-3,3.6,3.6,0,0,1,3-1.86h0a2.93,2.93,0,0,1,2.28,1.09,3,3,0,0,1,.61,2.59l-1-.21a2.1,2.1,0,0,0-.42-1.76A1.92,1.92,0,0,0,16.8,7.7h0A2.73,2.73,0,0,0,14.62,9.11Z">
          </path>
          <path
            d="M8.27,11.54h1a9.86,9.86,0,0,0-1-3A6.35,6.35,0,0,1,7.52,6,3.38,3.38,0,0,1,9,3.39c.16-.12.61-.46,1-.83.41.37.86.71,1,.83A3.38,3.38,0,0,1,12.48,6a6.36,6.36,0,0,1-.77,2.54,9.85,9.85,0,0,0-1,3h1a9.27,9.27,0,0,1,.88-2.61A7.06,7.06,0,0,0,13.46,6a4.37,4.37,0,0,0-1.86-3.37,11.42,11.42,0,0,1-1.25-1.07L10,1.15l-.36.39A11.41,11.41,0,0,1,8.39,2.61,4.37,4.37,0,0,0,6.54,6a7.06,7.06,0,0,0,.86,2.95A9.27,9.27,0,0,1,8.27,11.54Z">
          </path>
          <rect x="4.35" y="12.41" width="11.3" height="0.94"></rect>
        </svg></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto mb-2 mb-md-0">
          @include('components.nav-item', ['name' => 'Submit Notification', 'route' => 'root.index'])
          <li><a class="nav-link" href="https://cabotscouts.org.uk" target="_blank">Cabot Scouts</a></li>
        </ul>

        {{--
        <ul class="navbar-nav mb-2 mb-md-0">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
          </li>
          @endguest
        </ul>
        --}}
      </div>
    </div>
  </nav>
  <div class="container-lg my-4">
    <div class="alert alert-danger">
      This form is not yet active, please continue to use the <a href="https://bristolcabotscouts.org.uk/leader-resources/notification-guidance/activity-notification-form/" class="alert-link" target="_blank" ref="nofollow noreferrer">existing activity notification form</a> until it is replaced.
    </div>

    @yield('content')
  </div>
  <div class="text-center mt-2">
    <div>
      <div class="logo-inline-purple logo-inline-w150 mb-4">
        <h6>{{ config('scout.district') }}</h6>
      </div>
      <p class="text-muted mb-4"><small>&copy; {{ config('scout.district') }} Scout District
          {{ date('Y') }}</small>
      </p>
    </div>
  </div>
  <script src="{{ asset('static/bootstrap.min.js') }}"></script>
  @stack('body-additional')
</body>

</html>