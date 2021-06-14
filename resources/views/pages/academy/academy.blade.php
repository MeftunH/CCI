@extends('layouts.front')
@section('title')
    Academy
@endsection
@section('css')
@endsection

@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')
    <!-- Intro -->
    <section class="intro" style="background-image: url({{$academy->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$translation->title}}</h1>
                        <p class="intro_work">{!! $translation->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_02_gray (1).png')}}" >
        </div>
    </section>
    <!-- Career Consulting -->
    <section class="career" style="background-image: url('./frontend/img/background_dots_01.png');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="long-term_left" >
                        <div class="long_term-text">
                            <h1 class="long_term">{{$academy_career->title}}</h1>
                            <!-- <div class="texts"> -->
                            <p class="text"> {{$academy_career->description}}</p>
                            <!-- </div> -->
                        </div>
                        <div class="long-term_list">
                            <ul class="long-term_items">
                                @foreach($academy_career_items as $aci)
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">{{$aci->title}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    @foreach($academy_cards as $ac)
                        @switch($loop->index)
                            @case(0)
                    <div class="row careers-cards">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-01">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url({{$ac->image}});">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>{{$ac->title}}</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="{{route('academy.read_more',$ac->academy_card_id)}}">{{trans('back.read_more')}} <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        @break
                        @case(1)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-02">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url({{$ac->image}});">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>{{$ac->title}}</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="{{route('academy.read_more',$ac->academy_card_id)}}">{{trans('back.read_more')}} <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        @break
                    </div>

                    <div class="row careers-cards">
                        @case(2)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-03">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url({{$ac->image}});">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>{{$ac->title}}</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="{{route('academy.read_more',$ac->academy_card_id)}}">{{trans('back.read_more')}} <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        @break
                        @case(3)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-04">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url({{$ac->image}});">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>{{$ac->title}}</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="{{route('academy.read_more',$ac->academy_card_id)}}">{{trans('back.read_more')}} <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        @break
                    </div>
                        @endswitch
                    @endforeach
                </div>
            </div>

        </div>

        <!-- <div class="bottom-img">
            <img class="img-fluid" src="./img/white_bottom_wave_01.png">
        </div> -->
    </section>
@endsection
@section('js')
@endsection
