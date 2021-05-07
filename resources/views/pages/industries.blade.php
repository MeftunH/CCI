@extends('layouts.front')
@section('title')
    Industries
@endsection
@section('css')
@endsection

@section('content')

    <section class="intro" style="background-image: url('./frontend/img/hero_team.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Team</h1>
                        <p class="intro_work">Together we can create something all inspirational you need to build.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/white-bottom.png')}}" >
        </div>
    </section>
    <!-- Clients -->
    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="clients-img">
                        <img class="img-fluid" src="{{asset('./frontend/img/team_02.png')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="clients-right">
                        <div class="right-top">
                            <i class="fa fa-quote-right" aria-hidden="true"></i>

                            <h1 class="right-help">We help our clients reimagine, restructure and renew business functions to create agile and resilient organizations.</h1>
                            <p class="right-name">Keenan Webber</p>
                        </div>
                        <div class="right-bottom">
                            <p class="text">Nifty team is a diverse network of consultants and industry professionals with a global mindset and a collaborative culture. We work to understand your issues and are driven to ask better questions in the pursuit of making your business work better.</p>
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
