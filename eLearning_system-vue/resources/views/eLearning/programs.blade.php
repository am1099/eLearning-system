<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<link href="/css/bootstrap.min.css" rel="stylesheet" />

<style>
    canvas {
        position: absolute;
    }
</style>



<head>
    <title>Anfal IXL</title>
    <script src="{{ asset('js/face-api.min.js') }}" defer></script>
</head>
@include('layouts.eLearning_navbar')


<div id="app">
    <display-program :program="{{ json_encode($program) }}" :modules="{{ json_encode($modules) }}" :units="{{ json_encode($units) }}" :lessons="{{ json_encode($lessons) }}" :activities="{{ json_encode($activities) }}"></display-program>
    
</div>


<script language="JavaScript" type="text/javascript" src="{{ asset('js/script.js') }}" defer></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('js/activity1-methods.js') }}" defer></script>



@include('layouts.eLearning_footer')