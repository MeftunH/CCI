@extends('layouts.front')
@section('title')
    Services
@endsection
@section('css')
@endsection

@section('content')

    <section class="intro" style="background-image: url('./frontend/img/hero_testimonials.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Services</h1>
                        <p class="intro_work">Nifty team is a diverse network of consultants and industry professionals with a global mindset.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_02_gray.png')}}" >
        </div>
    </section>
    <!-- Innovation -->
    <section class="innovation innovation-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="innovation_left">
                        <h1 class="innovation_BF"><span class="innovation_color innovation_color-services ">Be at the forefront of</span> innovation</h1>
                        <p class="innovation_inform">We’re here to inform which tactics need funding and which are drainson resources.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="row innovation_cards">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="tech_card  innovation_card">
                                <img class="img-fluid" src="{{asset('./frontend/img/solution.svg')}}" width="100" height="100">
                                <div class="innovation_card_text">
                                    <p class="card_top_text">Strategic Consulting</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="tech_card  innovation_card">
                                <img class="img-fluid" src="{{asset('./frontend/img/global-services.svg')}}" width="100" height="100">
                                <div class="innovation_card_text">
                                    <p class="card_top_text">Project Scoping and Planning</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row innovation-cards">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="tech_card  innovation_card">
                        <img src="{{asset('./frontend/img/solution.svg')}}" width="100" height="100">
                        <div class="innovation_card_text">
                            <p class="card_top_text">Creative Cloud Solutions</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="tech_card  innovation_card">
                        <img src="{{asset('./frontend/img/solution.svg')}}" width="100" height="100">
                        <div class="innovation_card_text">
                            <p class="card_top_text">Infrastructure Capacity Planning</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="tech_card  innovation_card">
                        <img src="{{asset('./frontend/img/solution.svg')}}" width="100" height="100">
                        <div class="innovation_card_text">
                            <p class="card_top_text">Technology Services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="tech_card  innovation_card">
                        <img src="{{asset('./frontend/img/solution.svg')}}" width="100" height="100">
                        <div class="innovation_card_text">
                            <p class="card_top_text">Help Desk IT Services</p>
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
                        <h1 class="experience_text">Capitalizing on the real-world experience</h1>
                        <p class="experience-trends">We explore some of the latest trends and strategies</p>
                    </div>
                </div>
            </div>
            <div class="row experience-cards">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="experience-card">
                        <div class="card-top">
                            <div class="experience-img-01" style="background-image: url('./frontend/img/service_01-1280x960.jpg');">
                            </div>
                        </div>
                        <div class="experience-bottom">
                            <h3>Private individuals products & services</h3>
                            <p class="agile">Leverage agile frameworks to provide a robust synopsis for high level overviews iterative indicators offline.</p>
                            <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="experience-card">
                        <div class="card-top">
                            <div class="experience-img-01" style="background-image: url('./frontend/img/service_02-1280x960.jpg');">
                            </div>
                        </div>
                        <div class="experience-bottom">
                            <h3>Small & medium business clients aquisition</h3>
                            <p class="agile">Organically grow the holistic world view of disruptive innovation via workplace diversity will have multiple.</p>
                            <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="experience-card">
                        <div class="card-top">
                            <div class="experience-img-01" style="background-image: url('./frontend/img/service_03-1280x960.jpg');">
                            </div>
                        </div>
                        <div class="experience-bottom">
                            <h3>Corporate clients & services</h3>
                            <p class="agile">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day.</p>
                            <span class="card_bottom_text"><a class="innovation_link" href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-grey">
            <img class="img-fluid" src="{{asset('./frontend/img/top_grey.png')}}">
        </div>
    </section>
@endsection
@section('js')
@endsection
