<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-brown">
                <img src="{{ asset('img/logo.jpg') }}" width="25" height="25" class="mr-2 rounded-circle d-inline-block align-top" alt="">
                <a class="navbar-brand mr-auto mr-lg-0" href="#">{{ config('app.name', 'Laravel') }} - Verhuur</a>
        
                <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        &nbsp;
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fe fe-bell"></i>

                                    <span style="margin-top: -.25rem;" class="badge align-middle badge-pill badge-notifications">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                </a>
                        
                        <li class="nav-item">
                            <a href="{{ route('account.settings') }}" class="nav-link">
                                {{ Auth::user()->name }} 
                            </a>
                        </li>

                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas text-danger fa-power-off"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        
            <div class="nav-scroller bg-green shadow-sm">
                <nav class="nav nav-underline">
                    <a class="nav-link {{ active('home') }}" href="{{ route('home') }}">
                        <i class="fe fe-home mr-1"></i> Dashboard
                    </a>

                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admins.index') }}" class="nav-link {{ active('admins.*') }}">
                            <i class="fe mr-1 fe-users"></i> Admins & Leiding
                        </a>
                    @endif

                    @if (Auth::user()->hasAnyRole('admin', 'leiding')) 
                        <a href="" class="nav-link {{ active('calendar.*')  }}">
                            <i class="fe fe-calendar mr-1"></i>
                            Kalender
                        </a>

                        <a href="" class="nav-link {{ active('huurders.*') }}">
                            <i class="fe mr-1 fe-users"></i> Huurders
                        </a>
                        
                        <a href="{{ route('lokalen.index') }}" class="nav-link {{ active('lokalen.*') }}">
                            <i class="fe fe-list mr-1"></i> Lokalen
                        </a>

                        <a href="" class="nav-link {{ active('werkpunten.*') }}">
                            <i class="fe mr-1 fe-alert-triangle"></i> Werkpunten
                        </a>
                    @endif 
                </nav>
            </div>

            <main role="main" class="container-fluid">
                <div class="py-3">
                    @yield('content')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <span class="copyright"><i class="far fa-copyright"></i> {{ date('Y') }}, {{ config('app.name') }}</span>

                    <div class="float-right">
                        @if (Auth::user()->hasRole('huurder'))
                            <a href="" class="link-footer">
                                Gebruikersvoorwaarden
                            </a>
                        @endif

                        <a href="" class="link-footer">
                            <i class="fe fe-mr-2 fe-github"></i> Github
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
