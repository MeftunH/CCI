@extends('layouts.front')
@section('title')
    Index
@endsection

@section('css')

@endsection

@section('navbar')
    @include('layouts.navbar.index_navbar')
@stop
<!-- Intro -->
@section('content')
    <section class="intro home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="intro_text">
                        <h1 class="intro_IT">{!! $intro->title !!}</h1>
                        <p class="intro_work intro_work-home">{!! $intro->description !!}</p>
                        <a href="{{route('about')}}" class="intro_link intro_link-home intro_btn intro_btn-home">Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="header_bottom_img" style="z-index:2">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_left_grey.png')}}">
        </div>
    </section>
    <!-- Innovation -->
    <section class="innovation">
        <div class="top_img">
            <img class="img-fluid" src="{{asset('./frontend/img/top_right_black.png')}}" height="195">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="innovation_left">
                        <h1 class="innovation_BF">{!! $innovation_module->replace($innovation_module->title) !!}
                            </h1>
                        <p class="innovation_inform">{!! $innovation_module->description !!}</p>
                        <a href="{{route('services')}}"
                           class="innovation_btn innovation-btn">{{trans('front.our_services')}}</a>
                        <div class="floating_left_img">
                            <img class="floating-left-img img-fluid"
                                 src="{{asset('./frontend/img/floating_image_left.png')}}" width="400"
                                 height="400">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">

                    <div class="row innovation_cards">
                        @foreach($_limited_innovation_items as $li)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                                <div class="tech_card  innovation_card">
                                    <img class="img-fluid" src="{{asset($li->image)}}" width="100" height="100">
                                    <div class="innovation_card_text">
                                        <p class="card_top_text">{!! $li->title !!}</p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            @if(isset($_row_innovation_items))
                <div class="row innovation-cards">
                    @foreach($_row_innovation_items as $ri)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="tech_card  innovation_card">

                                <img src="{{asset($ri->image)}}" width="100" height="100">
                                <div class="innovation_card_text">
                                    <p class="card_top_text">{{$ri->title}}</p>
                                </div>

                            </div>
                        </div> @endforeach
                </div>
            @endif
            <div class="botton_dark">
                <img class="img-fluid " src="{{asset('./frontend/img/bottom_left_dark.png')}}">
            </div>
        </div>

    </section>
    <!-- Unlocking -->
    <section class="unlocking">
        <div class="floating_unlock_img">
            <img src="{{asset('./frontend/img/floating_image_13.png')}}">
        </div>
        <div class="top_right_img">
            <img class="img-fluid" src="{{asset('./frontend/img/top_right_grey.png')}}" height="195" class="img-fluid">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="row">
                        <div class="unlocking_text">
                            <div class="col-lg-12">
                                <h1 class="unlock_unlock">{!! $unlock_module->replace($unlock_module->title) !!}</h1>
                            </div>
                            <div class="col-lg-12">
                                <p class="unlock_bring">{!! $unlock_module->description !!}</p>
                            </div>
                            <div class="col-lg-12">
                                <a href="{{route('academy')}}"
                                   class="unlocking_btn unlocking-btn">{{trans('front.meet_our_experts')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="floating_unlocking">
                    <img src="{{asset('./frontend/img/floating_image_12.png')}}" class="img-fluid" width="285"
                         height="260">
                </div>
                <div class="col-lg-6 col-12">
                    <div class="unlocking_img">
                        <div class="unlocking-img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="company">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="good-company">
                            <span class="good_company">You'll be in good company</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" swiper-container">
                <div class="swiper-wrapper">
                    @foreach($_clients as $client)
                        <div class="swiper-slide">
                            <div class="slider">
                                <div class="swiper-img">
                                    <img class="img-fluid" src="{{asset($client->image)}}">
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="bottom_right">
                <img src="{{asset('./frontend/img/bottom_right_grey.png')}}" height="195" class="img-fluid">
            </div>
        </div>

    </section>
    <!-- Studies -->
    <section class="studies">
        <div class="top-dark">
            <img class="img-fluid" src="{{asset('./frontend/img/top_left_dark.png')}}" height="195">
        </div>
        <div class="floating_right_img">
            <img src="{{asset('./frontend/img/floating_image_14.png')}}" class="img-fluid" width="454" height="356">
        </div>
        <div class="floating_right_top">
            <img src="{{asset('./frontend/img/floating_image_15.png')}}" class="img-fluid" width="219" height="301">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="studies_text">
                        <h1 class="studies_case">{{trans('front.case')}} <span class="innovation_color">{{trans('front.studies')}}</span></h1>
                        <p class="studies_advice">We are able to give truly independent advice</p>
                    </div>
                </div>
            </div>
            <div class="row studies_cards">
                @foreach($_last_studies as $ls)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="studies-card">
                            <div class="studies_card_01" style="background-image: url('{{url($ls->image)}}');">
                            </div>
                            <div class="studies_card_text">
                                <a href="{{ URL::route('caseStudies.read_more',$ls->study_id) }}"><h3
                                        class="studies_coping studies_coping-case">{{$ls->title}}</h3></a>
                                <span class="studies_bottom_text"><a class="studies_link"
                                                                     href="{{ URL::route('caseStudies.read_more',$ls->study_id) }}">{{trans('back.read_more')}} <i
                                            class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="img-fluid" class="studies_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_left_dark.png')}}" height="195">
        </div>
    </section>
    <!-- Technology -->
    <section class="technology">
        <div class="top_left_img">
            <img class="img-fluid" src="{{asset('./frontend/img/top_right_grey.png')}}" height="195">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="row technology_cards">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="technology_card">
                                <img src="{{asset('./frontend/img/lightbulb.svg')}}" width="67" height="88">
                                <h3 class="cards_text"><span class="innovation_color">Product</span> Ideation</h3>
                                <p class="cards-text">Our expert staff is well experienced, trained and IT industry
                                    certified.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="technology_card">
                                <img src="{{asset('./frontend/img/lightbulb.svg')}}" width="67" height="88">
                                <h3 class="cards_text"><span class="innovation_color">System</span> Design</h3>
                                <p class="cards-text">Our CoE leads work directly with customers in this large and first
                                    phase.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="technology_card">
                                <img src="{{asset('./frontend/img/lightbulb.svg')}}" width="67" height="88">
                                <h3 class="cards_text"><span class="innovation_color">Technology</span> Services</h3>
                                <p class="cards-text">Award winning Technology Services to fit and scale with any size
                                    of your business.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="technology_card">
                                <img src="{{asset('./frontend/img/lightbulb.svg')}}" width="67" height="88">
                                <h3 class="cards_text"><span class="innovation_color">Network</span> Infrastructure</h3>
                                <p class="cards-text">Nifty offers four broad categories of services in its best
                                    Network.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="technology_img">
                        <img class="technology-img img-fluid" src="{{asset($tci->big_image)}}">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
@endsection
