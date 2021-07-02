@extends('layouts.front')
@section('title')
    Case Studies
@endsection
@section('css')

@endsection
<link rel="stylesheet" type="text/css" href="{{asset('./frontend/lightbox2/src/css/lightbox.css')}}">

@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

    <section class="intro intro_news"  style="background-image: url({{$news->image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text news_intro">
                        <h1 class="intro_about">{!! $news->title!!}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_02.png')}}" alt="">
        </div>
    </section>
    <!-- News -->
    <section class="eventsDetails">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="details-text">
                        <h5>{!! $news->description!!}</h5>
                    </div>
                </div>
            </div>
            @foreach($album as $item)
                <a href="{{url($item->image_path)}}"   data-lightbox="roadtrip">
                <img   src="{{ $item->image_path }}" style="width:200px; height:100px">
                </a>
            @endforeach
        </div>
    </section>
@endsection
@section('js')
    <script
        src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
        integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
        crossorigin="anonymous"></script>
    <script src="{{asset('frontend/lightbox2/src/js/lightbox.js')}}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
@endsection
