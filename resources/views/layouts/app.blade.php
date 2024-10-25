<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMISID Project Management System') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-left">
                    <img src="{{ asset('img/logo.png') }}" alt="CMISID Logo" width="50" height="50">
                    <img src="{{ asset('img/risewhite.png') }}" alt="CMISID Logo" width="70" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav-links me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">HOME</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}">PROJECTS</a>
                        </li>
                        
                        @if (auth()->user()->hasRole('project manager'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('offices.index')}}">OFFICES</a>
                            </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">ACCOUNT</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-btn btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <a class="nav-btn btn btn-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<style>
    * {
        font-family: "Poppins", sans-serif;
    }


    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #19358A;
        margin: 0;
        padding: 10px 20px;
    }

    .navbar-left {
        flex: 4cm;
    }

    .nav-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
        gap: 40px;
        text-decoration: none;
        color: white;
        font-weight: bold;
    }

    .navbar-right a {
        margin-left: 15px;
        color: white;
        font-weight: bold;
    }

    .nav-btn {
        font-size: 15px;
        font-weight: bold;
        background: #19358A;
        border: solid 1px;
        border-radius: 6px;
        border border-color: white;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 16px;
        padding-right: 16px;
        margin: 5px;
        text-align: center;
        color: white;
        text-decoration: none;
    }
</style>

</html>
