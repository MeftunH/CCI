@extends('layouts.front')
@section('title')
    Partners
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')
    <section class="intro intro_news" style="background-image: url({{$intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text news_intro">
                        <h1 class="intro_about"> {!! $intro->title !!} </h1>
                        <p class="intro_work">{!!  $intro->description !!} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_02_gray (1).png')}}" >
        </div>
    </section>
    <!-- Partners Block -->
    <section class="partners_block">
        <div class="container">
            <div class="row">
                @foreach($partners as $partner)
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset($partner->image)}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>{{$partner->title}}</h4>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
