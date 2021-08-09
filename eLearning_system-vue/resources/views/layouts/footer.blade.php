<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Anfal ixl') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="/css/navbar.css"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>

<style>
    .size {

        width: 100%;
        height: 2.5rem;
        
    }
</style>



<footer class="footer size fixed-bottom mt-4" style="background-color: #2B7A78">
    <div class="row">
        <div class="col-md-12 pt-2 copy">
            <p class="text-center pt-2" style="color: white"><strong> &copy; Copyright 2018 - Company Name. All rights reserved.</strong></p>
        </div>
    </div>
</footer>

</html>