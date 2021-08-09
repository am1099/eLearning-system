<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Anfal IXL') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script href="{{ asset('js/app.js') }}"></script>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar" style="background-color: #0f5298">

            <a class="navbar-brand " href="#">Anfel e-Learning System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container">
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto" style="position: absolute;
                    left: 50%;
                    transform: translateX(-50%);">
                        <li class="nav-item ">
                            <a class="nav-link active" href= "{{ route('eLearning_home') }}"><img style="padding-bottom:4px ;" src="https://img.icons8.com/material-rounded/20/ffffff/home.png" /> Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#"><img style="padding-bottom:4px ;" src="https://img.icons8.com/metro/20/ffffff/books.png" /> Programs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/eLearning/dashboard/1"><img style="padding-bottom:4px ;" src="https://img.icons8.com/ios-filled/20/ffffff/machine-learning.png" /> Dahsboard</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href= "{{ route('membershipView') }}"><img style="padding-bottom:4px ;" src="https://img.icons8.com/ios-filled/20/ffffff/badge.png" /> Membership</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="#"><img style="padding-bottom:4px ;" src="https://img.icons8.com/material/20/ffffff/add-contact-to-company--v1.png" /> Contact</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="#"><img style="padding-bottom:4px ;" src="https://img.icons8.com/android/20/ffffff/about.png" /> About</a>
                        </li>


                    </ul>
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><img style="padding-bottom:4px ;" src="https://img.icons8.com/android/20/ffffff/login-rounded-right.png" /> {{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img style="padding-bottom:4px ;" src="https://img.icons8.com/windows/24/ffffff/user-secured.png" /> {{ Auth::user()->fullname }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <img style="padding-bottom:4px ;" src="https://img.icons8.com/android/20/000000/logout-rounded-left.png" /> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>

                {{-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <form class="form">
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                        </form>
                    </li>
                </ul> --}}
            </div>
        </nav>
</body>

