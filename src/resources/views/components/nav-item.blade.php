<li class="nav-item @if ($route == Route::currentRouteName()) active @endif">
  <a class="nav-link" href="{{ route($route) }}">{{ $name }}</a>
</li>
