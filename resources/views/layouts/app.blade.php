<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167449868-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-167449868-1', {'anonymize_ip': true });
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>WoW Puggers</title>
  <meta name="description" content="A site for organising World of Warcraft Classic raids"/>
  <meta property="og:title" content="WoW Puggers">
  <meta property="og:description" content="A site for organising World of Warcraft Classic raids">
  <meta property="og:image" content="{{ url('/images/share.jpg') }}">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <script>var whTooltips = {};</script>
  <script src="https://wow.zamimg.com/widgets/power.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ $bodyClass ?? '' }}">
<div id="app">
  <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/images/logo.png" alt="logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('raids.index') }}">My Raids</a>
            </li>
          @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main id="main">
    @yield('content')
  </main>

  <footer class="footer bg-dark">
    <div class="container">
      <div class="row">
        <div class="col">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('privacy') }}">Privacy &amp; Cookies</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  @yield('modal')
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
