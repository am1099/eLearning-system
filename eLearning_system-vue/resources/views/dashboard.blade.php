<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Anfal IXL</title>
</head>

@include('layouts.navbar')
@include('layouts.user_navbar')

<div class="container">
    <div class="container">
        @if (session()->has('success'))
        <div class="alert alert-success text-center">
            <strong>{{ session()->get('success') }}</strong>
        </div>
        @endif
    </div>
    <div id="app" class="pt-3 mb-5">

        @if (Auth::user()->user_role == 'Admin')
        <div class="row">
            <systemstat-cards></systemstat-cards>
        </div>
        <hr style="width: 100%; border-top: 2px solid #999" />

        <div class="row pt-4">
            <users-table></users-table>
        </div>
        @elseif (Auth::user()->user_role == 'Validator')
        <div class="row">
            <valstat-cards :stats="{{ json_encode($validatedPrograms) }}"></valstat-cards>
        </div>
        <div class="row pt-4">
            @if (Auth::check())
            <valprogram-cards :user="{{ Auth::user() }}" :prog="{{ json_encode($prog) }}"></valprogram-cards>

            @else
            <program-cards :user="false"></program-cards>

            @endif
        </div>
        <hr style="width: 100%; border-top: 2px solid #999" />

        <div class="row pt-2">
            <validation-progress></validation-progress>
        </div>
        @endif
    </div>
</div>

@include('layouts.footer')