<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Anfel PCB</title>

</head>

@include('layouts.navbar')
@include('layouts.user_navbar')

<div class="container">
    <div id="app" class="pt-3">
        <program-form></program-form>
    </div>
</div>

@include('layouts.footer')