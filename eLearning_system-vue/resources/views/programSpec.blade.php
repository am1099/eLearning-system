<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Anfal IXL</title>
</head>

@include('layouts.navbar')
<div class="row">
    <div class="col-3">
        @include('layouts.user_navbar')
    </div>
    <div class="col">
        <div class="container">
            <div class="container">
                @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    <strong>{{ session()->get('success') }}</strong>
                </div>
                @endif
            </div>
            <div id="app" class="pt-3">


                <div class="row">
                    <stat-cards :stats="{{ json_encode($object) }}"></stat-cards>
                </div>
                <div class="row pt-4">
                    @if (Auth::check())
                    <program-cards :user="{{ Auth::user() }}" :prog="{{ json_encode($prog) }}"></program-cards>

                    @else
                    <program-cards :user="false"></program-cards>

                    @endif
                </div>
                <hr style="width: 100%; border-top: 2px solid #999" />

                <div class="row pt-2">
                    <validation-progress></validation-progress>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')