@extends('layouts.front')
@section('title')
    News
@endsection
@section('css')
@endsection

@section('content')

    <section class="intro intro_news" style="background-image: url('./frontend/img/featured_image_blog.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text news_intro">
                        <h1 class="intro_about">Latest News</h1>
                        <p class="intro_work">We are a young and creative company and we offer you fresh business ideas for your team and company.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_02.png')}}" >
        </div>
    </section>
    <!-- News -->
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class=" swiper-container" id="swiper_container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="news-card">
                                    <div class="news_card_01" style="background-image: url('./frontend/img/portfolio_03\ \(1\).jpg');">
                                    </div>
                                    <!-- <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-news">Consulting </span> <span class=" studies_recruitment studies_recruitment-news">Recruitment</span>
                                        <h3 class="studies_coping studies_consulting-news">Coping Under the Current Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div> -->
                                </div>
                            </div>
                            <!-- </div> -->
                            <!-- <div class="swiper-wrapper"> -->
                            <div class="swiper-slide">
                                <div class="news-card">
                                    <div class="news_card_01" style="background-image: url('./frontend/img/portfolio_02\ \(1\).jpg');">
                                    </div>
                                    <!-- <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-news ">Consulting </span> <span class="studies_recruitment studies_recruitment-news">Recruitment</span>
                                        <h3 class="studies_coping studies_consulting-news">Coping Under the Current Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                    </div> -->
                                </div>
                            </div>
                            <!-- </div> -->
                            <!-- <div class="swiper-wrapper"> -->
                            <div class="swiper-slide">
                                <div class="news-card">
                                    <div class="news_card_01" style="background-image: url('./frontend/img/portfolio_04.jpg');">
                                    </div>
                                    <!-- <div class="studies_card_text">
                                        <span class="studies_consulting studies_consulting-news">Consulting </span> <span class="studies_recruitment studies_recruitment-news">Recruitment</span>
                                        <h3 class="studies_coping studies_consulting-news">Coping Under the Current Climate</h3>
                                        <span class="studies_bottom_text"><a class="studies_link" href="#">READ MORE <i class="fas fa-arrow-circle-right studies_icon"></i></a></span>
                                     </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div class="news-left_text">
                        <span class="studies_consulting studies_consulting-news">Consulting </span> <span class=" studies_recruitment studies_recruitment-news">Recruitment</span>
                        <h3 class="studies_coping studies_coping_news">Coping Under the Current Climate</h3>
                        <p>Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment. User generated content in real-time.
                        </p>
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
