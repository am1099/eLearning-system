<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Anfel PCB</title>
</head>
<style>
    .line-black {
        margin: 0 auto;
        width: 100%;
        height: 3px;
        background-color: rgb(185, 182, 182);
    }
</style>

@include('layouts.navbar')
@include('layouts.user_navbar')

<div class="container">
    <div id="app" class="pt-3">
        <view-activity :user="{{ Auth::user() }}" :lesson="{{ json_encode($lesson[0]) }}" :activity="{{ json_encode($activity[0]) }}"></view-activity>
    </div>
</div>

@include('layouts.footer')