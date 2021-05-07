@extends('layouts.front')
@section('title')
    Case Studies
@endsection
@section('css')
@endsection

@section('content')
    <section class="intro" style="background-image: url('./frontend/img/hero_clients.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Clients</h1>
                        <p class="intro_work">We exceed our client’s expectations. Here, you can find some of the clients we have worked with.</p>
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
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="swiper-img">
                                <img class="img-fluid" src="{{asset('./frontend/img/client-logo-triangle.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="swiper-img">
                                <img class="img-fluid" src="{{asset('./frontend/img/client-logo-limita.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="swiper-img">
                                <img class="img-fluid" src="{{asset('./frontend/img/client-logo-dorcol.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="swiper-img">
                                <img class="img-fluid" src="{{asset('./frontend/img/client-logo-skittared.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}" >
        </div>
    </section>
    <!-- Our Clients -->
    <section class="clients">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="clients-text">
                        <h1 class="our-clients">Our Clients</h1>
                        <h3 class="clients-explore">We explore some of the latest trends and strategies</h3>
                    </div>
                </div>
            </div>
            <div class="row logo">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-11.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-01.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-12.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-02.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-11.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-01.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-12.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-02.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-11.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-01.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-12.png')}}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6  ">
                    <div class="client-logo">
                        <img src="{{asset('./frontend/img/client-logo-grey-02.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Studies -->
    <section class="studies">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="studies_text">
                        <h1 class="studies_case">Case <span class="innovation_color innovation_color-case">Studies</span></h1>
                        <p class="studies_advice">We are able to give truly independent advice</p>
                    </div>
                </div>
            </div>
            <div class="row studies_cards">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="studies-card">
                        <div class="studies_card_01" style="background-image: url('./frontend/img/portfolio_01.jpg');">
                        </div>
                        <div class="studies_card_text">
                            <span class="studies_consulting studies_consulting-case ">Consulting </span> <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                            <h3 class="studies_coping studies_coping-case">Coping Under the Current Climate</h3>
                            <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="studies-card">
                        <div class="studies_card_02">
                        </div>
                        <div class="studies_card_text">
                            <span class="studies_consulting studies_consulting-case ">Consulting </span> <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                            <h3 class="studies_coping studies_coping-case">Coping Under the Current Climate</h3>
                            <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="studies-card">
                        <div class="studies_card_03">
                        </div>
                        <div class="studies_card_text">
                            <span class="studies_consulting studies_consulting-case">Consulting </span> <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                            <h3 class="studies_coping studies_coping-case">Coping Under the Current Climate</h3>
                            <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="studeis-btn">
                <a href="#" class="intro_link intro_btn intro_btn-case" >All Case Studies</a>
            </div>


        </div>
        <div class="studies-bottom">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_grey_bottom_left_shape_01.png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
