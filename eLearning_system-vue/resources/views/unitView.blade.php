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
        <view-unit :user="{{ Auth::user() }}" :unit="{{ json_encode($unit[0]) }}" :module="{{ json_encode($module[0]) }}"></view-unit>
        <hr class="line-black">
        <lessons-table :lessons="{{ json_encode($lessons) }}" :unit="{{ json_encode($unit[0]) }}"></lessons-table>
    </div>
</div>

@include('layouts.footer')