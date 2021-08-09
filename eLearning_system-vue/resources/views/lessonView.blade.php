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
        <view-lesson :user="{{ Auth::user() }}" :lesson="{{ json_encode($lesson[0]) }}" :unit="{{ json_encode($unit[0]) }}"></view-lesson>
        <hr class="line-black">
        <activities-table :activities="{{ json_encode($activities) }}" :lesson="{{ json_encode($lesson[0]) }}"></activities-table>
    </div>
</div>

@include('layouts.footer')