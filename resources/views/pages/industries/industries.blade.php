@extends('layouts.front')
@section('title')
    Industries
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

    <section class="intro" style="background-image: url('{{$industry->background_image}}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$translation->title}}</h1>

                        <p class="intro_work">  {!! $translation->description!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('frontend/img/white-bottom.png')}}" >
        </div>
    </section>
    <!-- Clients -->
    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="clients-img">
                        <img class="img-fluid" src="{{asset($industry_client->background_image)}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="clients-right">
                        <div class="right-top">
                            <i class="fa fa-quote-right" aria-hidden="true"></i>

                            <h1 class="right-help">{{$industry_client_translation->title}}</h1>
                        </div>
                        <div class="right-bottom">

                            <p class="text">   {!! $industry_client_translation->description!!} </p>
                            <div class="long-term_list">
                                <ul class="long-term_items">
                                    @foreach($industry_client_items as $ici)
                                    <li class="long-terms_link">
                                        <i class="far fa-check-circle long-icon"></i>
                                        <span class="long-text">{{$ici->title}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Experience -->
    <section class="experience">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="experience-text">
                        <h1 class="experience_text">{{trans('industryPage.experience_text')}}</h1>
                        <p class="experience-trends">{{trans('industryPage.experience-trends')}}</p>
                    </div>
                </div>

            </div>
            <div class="row experience-cards">
                @foreach($experience_items as $experience_item)
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="experience-card">
                        <div class="card-top">
                            <div class="experience-img-01" style="background-image: url('{{$experience_item->image}}');">
                            </div>
                        </div>
                        <div class="experience-bottom">
                            <h3>{{$experience_item->title}}</h3>
                            <p class="agile">{{$experience_item->limit($experience_item->description)}}</p>
                            <span class="card_bottom_text"><a class="innovation_link" href="{{route('industry.read_more',$experience_item->experience_id)}}">{{trans('front.read_more')}} <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
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
