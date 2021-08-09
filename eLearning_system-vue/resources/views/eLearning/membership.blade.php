<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Anfal ELS</title>
</head>

@include('layouts.eLearning_navbar')

<div class="container mb-5">
    <div class="container mt-4 mb-4">
        <div class="container text-center font-weight-bold mt-3 mb-5">
            <h1>Membership plans</h1>
        </div>

        <div class="container text-center">
            <h5>Choose the right type of membership plan for you!</h5>
        </div>
        <hr>

        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold"><b>Package one</b></h5>
                    <hr>
                    <div class="text-center">
                        <p class="card-text text-center">
                        <h2>£10</h2>
                        <p>Weekly</p>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" style="background-color: #012929" class="btn text-center text-white">Buy now</button>
                    </div>
                </div>

            </div>
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold"><b>Package two</b></h5>
                    <hr>
                    <div class="text-center">
                        <p class="card-text text-center">
                        <h2>£30</h2>
                        <p>Monthly</p>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" style="background-color: #012929" class="btn text-center text-white">Buy now</button>
                    </div>
                </div>

            </div>
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold"><b>Package three</b></h5>
                    <hr>
                    <div class="text-center">
                        <p class="card-text text-center">
                        <h2>£300</h2>
                        <p>Yearly</p>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" style="background-color: #012929" class="btn text-center text-white">Buy now</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('layouts.eLearning_footer')