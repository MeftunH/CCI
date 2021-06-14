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
    <section class="intro" style="background-image: url({{$case_study->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$case_study->title}}</h1>

                        <p class="intro_work"> {!! $case_study->description!!}</p>
                    </div>
                </div>
            </div>
            <div class="company">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="good-company">
                            <span class="good_company">{{$case_study->footer}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" swiper-container">
                <div class="swiper-wrapper">
                    @foreach($slider_clients as $sc)
                        <div class="swiper-slide">
                            <div class="slider">
                                <div class="swiper-img" style="filter: invert(54%) sepia(7%) saturate(10%) hue-rotate(45deg) brightness(92%) contrast(89%);">
                                    <img class="img-fluid" src="{{$sc->image}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}">
        </div>
    </section>
    <!-- Our Clients -->
    <section class="clients">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="clients-text">
                        <h1 class="our-clients">{{trans('caseStudyPage.our-clients')}}</h1>
                        <h3 class="clients-explore">{{trans('caseStudyPage.clients-explore')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row logo">
                @foreach($clients as $client)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="client-logo">
                            <img src="{{$client->image}}">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Studies -->
    <section class="studies">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="studies_text">
                        <h1 class="studies_case">{{trans('caseStudyPage.Case')}} <span
                                class="innovation_color innovation_color-case">{{trans('caseStudyPage.studies')}} </span>
                        </h1>
                        <p class="studies_advice">{{trans('caseStudyPage.studies_advice')}}</p>
                    </div>
                </div>
            </div>
            <div class="row studies_cards">
                @foreach($last_studies as $ls)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="studies-card">
                            <div class="studies_card_01" style="background-image: url('{{url($ls->image)}}');">
                            </div>
                            <div class="studies_card_text">
                                <a href="{{ URL::route('caseStudies.read_more',$ls->study_id) }}">    <h3 class="studies_coping studies_coping-case">{{$ls->title}}</h3> </a>
                                <span class="studies_bottom_text"><a class="studies_link" href="{{ URL::route('caseStudies.read_more',$ls->study_id) }}">{{trans('back.read_more')}} <i
                                            class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="studeis-btn">
                <a href="{{route('caseStudies.all')}}" class="intro_link intro_btn intro_btn-case">All Case Studies</a>
            </div>


        </div>
        <div class="studies-bottom">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_grey_bottom_left_shape_01.png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
