<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>--}}
    <script src="https://kit.fontawesome.com/425f3e38f0.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar sticky-top navbar-dark bg-primary navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/logo.jpg')}}" width="30" height="30" alt="">
            </a>

            <a class="navbar-brand" href="{{route('home')}}">STAN TRIP CONTAINER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('order.index') ? 'active' : '' }}" href="{{route('order.index')}}">Buyurtmalar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('payment.index') ? 'active' : '' }}" href="{{route('payment.index')}}">To'lovlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('setting.index') ? 'active' : '' }} disabled" href="{{route('setting.index')}}">Sozlamalar</a>
                    </li>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
{{--    <nav class="navbar navbar-expand-lg navbar-light bg-light">--}}
{{--        <div class="container-fluid">--}}
{{--            <a class="navbar-brand" href="{{route('home')}}">STAN TRIP CONTAINERS</a>--}}
{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"--}}
{{--                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"--}}
{{--                    aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <div class="row px-4">--}}
{{--        <div class="col-3">--}}
{{--            <div id="list-example" class="list-group py-4">--}}
{{--                <a class="list-group-item list-group-item-action {{ Route::is('home') ? 'active' : '' }}"--}}
{{--                   href="{{route('home')}}">Asboblar paneli</a>--}}
{{--                <a class="list-group-item list-group-item-action {{ Route::is('order.index') ? 'active' : '' }}"--}}
{{--                   href="{{route('order.index')}}">Buyurtmalar</a>--}}
{{--                <a class="list-group-item list-group-item-action {{ Route::is('payment.index') ? 'active' : '' }}"--}}
{{--                   href="{{route('payment.index')}}">To'lovlar</a>--}}
{{--                <a class="list-group-item list-group-item-action disabled {{ Route::is('setting.index') ? 'active' : '' }}"--}}
{{--                   href="{{route('setting.index')}}">Sozlamalar</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-9">--}}
{{--            --}}
{{--        </div>--}}
{{--    </div>--}}
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
