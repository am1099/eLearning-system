<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Anfal ixl') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>


<!-- Navigation -->
<nav class="nav navbar-expand flex-column" id="shadow">
    <div class=" container">
            <ul class="navbar-nav m-auto">
                <li class="nav-item pr-3">
                    <a class="nav-link fas fa-tachometer-alt active" href="{{ route('dahsboard') }}"><img src="https://img.icons8.com/windows/24/ffffff/performance-2.png" /> Dashboard <span class="sr-only">(current)</span></a>
                </li>

                @if(Auth::user()->user_role != 'Validator')

                <li class="nav-item pr-3">
                    <a class="nav-link" href="{{ route('program_specification') }}"> <img src="https://img.icons8.com/dotty/24/ffffff/syllabus.png"/> Syllabus Specs <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item pr-3">
                </li>
                <li class="nav-item pr-3">
                    <a class="nav-link" href="#"><img src="https://img.icons8.com/wired/24/ffffff/pictures-folder.png"/> Graphics </a>
                </li>
                <li class="nav-item pr-3">
                    <a class="nav-link" href="#"><img src="https://img.icons8.com/ios/24/ffffff/game-maker.png"/> Activity Dev </a>
                </li>
                @endif
                <li class="nav-item pr-3">
                    <a class="nav-link" href="#"><img src="https://img.icons8.com/material-rounded/24/ffffff/submit-for-approval.png"/> Validator</a>
                </li>
                <li class="nav-item pr-3">
                    <a class="nav-link" href="#"><img src="https://img.icons8.com/ios/24/ffffff/multiple-messages.png"/> Messages</a>
                </li>

                <li class="nav-item pr-3">
                    <a class="nav-link " href="#"><img src="https://img.icons8.com/windows/24/ffffff/graph.png" /> Statistics</a>
                </li>
                
                <li class="nav-item pr-3">
                    <a class="nav-link " href="#">
                        <img src="https://img.icons8.com/windows/24/ffffff/user.png" />Profile</a>
                </li>
                <li class="nav-item pr-3">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <img style="padding-bottom:4px ;" src="https://img.icons8.com/android/20/ffffff/logout-rounded-left.png" /> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
</nav>

</html>