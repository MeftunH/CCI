@extends('layouts.front')
@section('title')
    Careers
@endsection
@section('css')
@endsection

@section('content')

    <!-- Intro -->
    <section class="intro" style="background-image: url('./frontend/img/hero_contact (1).jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Careers</h1>
                        <p class="intro_work">Nifty team is a diverse network of consultants and industry professionals.</p>
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
                            <h1 class="long_term">Career in Consulting</h1>
                            <div class="HR">
                                <span class="lg_young">We are a young and creative company and we offer you fresh HR ideas.</span>
                            </div>
                            <!-- <div class="texts"> -->
                            <p class="text">Nifty team is a diverse network of consultants and industry professionals with a global mindset and a collaborative culture. We work to understand your issues and are driven to ask better questions in the pursuit of making your business work better.</p>
                            <!-- </div> -->
                        </div>
                        <div class="long-term_list">
                            <ul class="long-term_items">
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">Valuation Services</span>
                                </li>
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">Development of Financial Models</span>
                                </li>
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">Corporate Financial Advisory</span>
                                </li>
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">Deal Structuring</span>
                                </li>
                                <li class="long-terms_link">
                                    <i class="far fa-check-circle long-icon"></i>
                                    <span class="long-text">Feasibility Studies & Business Plans
                                            </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row careers-cards">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-01">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url('./frontend/img/service_01-1280x960 (1).jpg');">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>HR Consultancy & Solutions</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-02">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url('./frontend/img/service_02-1280x960 (1).jpg');">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>Customized Talent Acquisition</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row careers-cards">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-03">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url('./frontend/img/service_03-1280x960 (1).jpg');">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>HR On-Demand Subscription</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="careers-card card-top-04">
                                <div class="card-top">
                                    <div class="careers-img-01" style="background-image: url('./frontend/img/service_04-1280x960 (1).jpg');">
                                    </div>
                                </div>
                                <div class="experience-bottom">
                                    <h3>Training & Development</h3>
                                    <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <div class="bottom-img">
            <img class="img-fluid" src="{{asset('./frontend/img/white_bottom_wave_01.png')}}">
        </div>
    </section>
    <!-- Upload CV -->
    <section class="upload">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="upload-left">
                        <img class="img-fluid" src="{{asset('./frontend/img/team_03.png')}}">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="upload-right">
                        <div class="upload-text">
                            <h1 class="text-work">Let’s work together</h1>
                            <div class="best">
                                <span class="upload-best">The Best Financial Consulting Firm You Can Count On!</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <form class="form-carrers">
                                    <label class="label-careers" for="cv">Upload Your CV (required)</label>
                                    <div class="form-send">
                                        <input class="input-careers" id="cv" name="your cv" required type="file">
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!--
                                                        <div class="studeis-btn">
                                                            <a href="#" class="intro_link intro_btn" >All Case Studies</a>
                                                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="wave-bottom">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_grey_bottom_left_shape_01 (1).png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
