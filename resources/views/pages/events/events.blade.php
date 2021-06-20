@extends('layouts.front')
@section('title')
    Events
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop

@section('content')
    <!-- Intro -->
    <section class="intro" style="background-image: url({{$intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
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
    <!-- Swaper -->
    <section class="swaper__">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class=" swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($events as $row)

                                <div class="swiper-slide">
                                    <div class="studies-card">
                                        <div class="studies_card_01"
                                             style="background-image: url({{$row->image}});">
                                        </div>
                                        <div class="studies_card_text">
                                            <h3 class="studies_coping studies_coping-case">{{$row->title}}</h3>
                                            <span class="studies_bottom_text"><a class="studies_link" href="{{route('events.read_more',$row->event_id)}}">{{trans('front.read_more')}} <i
                                                        class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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
