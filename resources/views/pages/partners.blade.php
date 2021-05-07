@extends('layouts.front')
@section('title')
    Partners
@endsection
@section('css')
@endsection

@section('content')
    <section class="intro intro_news" style="background-image: url('./frontend/img/featured_image_blog.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text news_intro">
                        <h1 class="intro_about"> Partners</h1>
                        <p class="intro_work">We are a young and creative company and we offer you fresh business ideas for your team and company.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_02_gray (1).png')}}" >
        </div>
    </section>
    <!-- Partners Block -->
    <section class="partners_block">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/img-1585668553.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>IBM</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/2.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Motorola Solutions</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/3.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Zebra Technology</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/4.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Huawei</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/5.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Panda Security</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/6.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Matrix Telecom</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/7.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Palo Alto Network</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partners__item">
                        <div class="partners__item_img">
                            <img class="img-fluid" src="{{asset('./frontend/img/8.png')}}">
                        </div>
                        <div class="partners__item_text">
                            <h4>Microsoft</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
