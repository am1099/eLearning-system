<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<link href="/css/bootstrap.min.css" rel="stylesheet" />

<style type="text/css">
    .imageH {
        height: 35rem
    }
</style>

<head>
    <title>Anfal IXL</title>
</head>
@include('layouts.eLearning_navbar')

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/images/learn3.jpg" class="w-100 imageH" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/images/learn1.jpg" class="w-100 imageH" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/images/learn2.jpg" class="w-100 imageH" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div id="app" class="pt-3 mb-5">
    <div class="container">

        <ul class="nav nav-tabs justify-content-lg-center pt-3 ">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="programs-tab" data-toggle="pill" href="#programs" role="tab" aria-controls="programs" aria-selected="true">Programs</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="profile" aria-selected="false">My project</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="programs" role="tabpanel" aria-labelledby="programs-tab">
                <div class="container">
                    <card-programs :prog="{{ json_encode($prog) }}"></card-programs>
                </div>
            </div>
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="container">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                    a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.eLearning_footer')