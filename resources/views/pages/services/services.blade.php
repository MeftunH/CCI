@extends('layouts.front')
@section('title')
    {{trans('front.services')}}
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

    <section class="intro" style="background-image: url({{$service_intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$service_intro->title}}</h1>

                        <p class="intro_work">{!! $service_intro->description!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_02_gray.png')}}">
        </div>
    </section>
    <!-- Innovation -->
    <section class="innovation innovation-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="innovation_left">
                        <h1 class="innovation_BF">{!! $innovation->replace($innovation->title) !!}</h1>
                        <p class="innovation_inform">{!! $innovation->description!!}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">

                    <div class="row innovation_cards">
                        @foreach($limited_items as $li)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="tech_card  innovation_card">
                                    <img class="img-fluid" src="{{asset($li->image)}}" width="100" height="100">
                                    <div class="innovation_card_text">
                                        <p class="card_top_text">{{$li->title}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            @if(isset($row_items))
                <div class="row innovation-cards">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="tech_card  innovation_card">
                            @foreach($row_items as $ri)
                                <img src="{{asset($ri->image)}}" width="100" height="100">
                                <div class="innovation_card_text">
                                    <p class="card_top_text">{{$ri->title}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Experience -->
    <section class="experience">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="experience-text">
                        <h1 class="experience_text">{{trans('servicePage.experience_text')}}</h1>
                        <p class="experience-trends">{{trans('servicePage.experience-trends')}}</p>
                    </div>
                </div>
            </div>
            <div class="row experience-cards">
                @foreach($service_cards as $sc)
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="experience-card">
                        <div class="card-top">
                            <div class="experience-img-01"
                                 style="background-image: url({{$sc->image}});">
                            </div>
                        </div>
                        <div class="experience-bottom">
                            <h3>{{$sc->title}}</h3>
                            <p class="agile">{!! $sc->description!!}</p>
                            <span class="card_bottom_text"><a class="innovation_link" href="{{ URL::route('services.read_more',$sc->service_card_id) }}">{{trans('front.read_more')}} <i
                                        class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="top-grey">
            <img class="img-fluid" src="{{asset('./frontend/img/top_grey.png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
