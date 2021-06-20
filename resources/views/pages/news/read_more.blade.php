@extends('layouts.front')
@section('title')
    Case Studies
@endsection
@section('css')
@endsection

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


        </div>
    </section>
@endsection
@section('js')
@endsection
