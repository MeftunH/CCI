@extends('layouts.front')
@section('title')
    Events
@endsection
@section('css')
@endsection


@section('content')
    <!-- Intro -->
    <section class="intro" style="background-image: url('/frontend/img/featured_image_blog.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Latest News</h1>
                        <p class="intro_work">We are a young and creative company and we offer you fresh business ideas
                            for your team and company.</p>
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
                            <div class="swiper-slide">
                                <div class="studies-card">
                                    <div class="studies_card_01"
                                         style="background-image: url('./frontend/img/portfolio_01.jpg');">
                                    </div>
                                    <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-case ">Consulting </span>
                                        <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                                        <h3 class="studies_coping studies_coping-case">Coping Under the Current
                                            Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i
                                                    class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="studies-card">
                                    <div class="studies_card_01"
                                         style="background-image: url('./frontend/img/portfolio_01.jpg');">
                                    </div>
                                    <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-case ">Consulting </span>
                                        <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                                        <h3 class="studies_coping studies_coping-case">Coping Under the Current
                                            Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i
                                                    class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="studies-card">
                                    <div class="studies_card_01"
                                         style="background-image: url('./frontend/img/portfolio_01.jpg');">
                                    </div>
                                    <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-case ">Consulting </span>
                                        <span class="studies_recruitment studies_recruitment-case">Recruitment</span>
                                        <h3 class="studies_coping studies_coping-case">Coping Under the Current
                                            Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i
                                                    class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div>
                                </div>
                            </div>
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
