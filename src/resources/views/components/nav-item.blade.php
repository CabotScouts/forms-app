<li @class(['nav-item', 'active' => $route == Route::currentRouteName()])>
  <a class="nav-link" href="{{ route($route) }}">{{ $name }}</a>
</li>
