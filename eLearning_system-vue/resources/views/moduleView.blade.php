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
        <view-module :user="{{ Auth::user() }}" :module="{{ json_encode($module[0]) }}" :program="{{ json_encode($program[0]) }}"></view-module>
        <hr class="line-black">
        <units-table :units="{{ json_encode($units) }}" :module="{{ json_encode($module[0]) }}"></units-table>
    </div>
</div>

@include('layouts.footer')