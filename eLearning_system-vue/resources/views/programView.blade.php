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
        <view-program :user="{{ Auth::user() }}" :program="{{ json_encode($program[0]) }}"></view-program>
        <hr class="line-black">
        <modules-table :modules="{{ json_encode($modules) }}" :program="{{ json_encode($program[0]) }}"></modules-table>
    </div>
</div>

@include('layouts.footer')