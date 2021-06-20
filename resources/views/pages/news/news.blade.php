@extends('layouts.front')
@section('title')
    News
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
                        <h1 class="intro_about">{{$intro->title}}</h1>
                        <p class="intro_work">{!! $intro->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_02.png')}}">
        </div>
    </section>
    <!-- News -->
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class=" swiper-container" id="swiper_container">
                        <div class="swiper-wrapper">
                            @foreach($news as $row)
                                <div class="swiper-slide">

                                    <div class="news-card">
                                        <div class="news_card_01" style="background-image: url('{{$row->image}}');">
                                        </div>
                                        <div class="studies_card_text">
                                            <h3 class="studies_coping studies_consulting-news">{!! $row->title !!}</h3>
                                            <span class="studies_bottom_text"><a class="studies_link" href="{{route('news.read_more',$row->news_id)}}">{{trans('back.read_more')}} <i
                                                        class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div class="row card-bottom-text">
                        <div class="col-lg-6">
                            <div class="social">
                                <a class="social_link social_link-news" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="social_link social_link-news" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="social_link social_link-news" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
