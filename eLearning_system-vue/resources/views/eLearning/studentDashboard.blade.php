<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<link href="/css/bootstrap.min.css" rel="stylesheet" />

<head>
    <title>Anfal IXL</title>
</head>
@include('layouts.eLearning_navbar')


<div id="app">
    <div class="container-fluid" style="width: 75%">
        <student-dashboard :user="{{ Auth::user() }}"></student-dashboard>
    </div>
</div>

@include('layouts.eLearning_footer')