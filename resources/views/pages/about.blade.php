@extends('layouts.front')
@section('title')
    About
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

        <!-- Intro -->
        <section class="intro" style="background-image: url('/frontend/img/hero_about_us.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="intro_text">
                            <h1 class="intro_about">About</h1>
                            <p class="intro_work">We are a young and creative company and we offer you fresh business ideas.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom_img">

    <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}" >
</div>
</section>
<!-- Long-Term -->
<section>
<div class="container">
    <div class="row long-term">
        <div class="col-lg-6 col-12">
            <div class="long-term_left">
                <div class="long_term-text">
                    <h1 class="long_term">Long-term vision and trajectory</h1>
                    <div class="HR">
                        <span class="lg_young">We are a young and creative company and we offer you fresh HR ideas.</span>
                    </div>
                    <!-- <div class="texts"> -->
                    <p class="text">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive.</p>
                    <p class="text">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution user generated.</p>
                    <!-- </div> -->

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
        <div class="col-lg-6">
            <div class="long-term_right">
                <span class="line_lg"></span>
                <div class="lg-circle">
                    <div class="lg-circle_2016">
                        <h3 class="lg-circle-number">2016</h3>
                    </div>
                </div>
                <div class="lg-cards_01">
                    <div class="lg-cards_card_01">
                        <span class="card-month">JANUAR 2016</span>
                        <h3 class="card-office">New office in London</h3>
                    </div>
                    <div class="lg-cards_card_02">
                        <span class="card-month">JULY 2016</span>
                        <h3 class="card-office">Certificate of Accreditation</h3>
                    </div>
                </div>

                <div class="lg-circle">
                    <div class="lg-circle_2018">
                        <h3 class="lg-circle-number">2018</h3>
                    </div>
                </div>
                <div class="lg-cards_02">
                    <div class="lg-cards_card_03">
                        <span class="card-month">JANUAR 2016</span>
                        <h3 class="card-office">New office in Amsterdam</h3>
                    </div>
                </div>

                <div class="lg-circle">
                    <div class="lg-circle_2019">
                        <h3 class="lg-circle-number">2019</h3>
                    </div>
                </div>
                <div class="lg-cards_03">
                    <div class="lg-cards_card_04">
                        <span class="card-month">FEBRUARY 2019</span>
                        <h3 class="card-office">New office in NY</h3>
                    </div>
                    <div class="lg-cards_card_05">
                        <span class="card-month">MARCH 2020</span>
                        <h3 class="card-office">More than 100 workers</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</section>
<!-- Operational -->
<section class="operational">
<div class="top-img ">
    <img class="img-fluid" src="{{asset('./frontend/img/top_wave_03.png')}}">
</div>
<div class="floating-img-top">
    <img class="img-fluid" src="{{asset('./frontend/img/floating_image_03.png')}}">
    <img class="img-fluid" src="{{asset('./frontend/img/floating_image_05.png')}}">
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="operational_text">
                <h1 class="operational_process">The operational processes are what drives the business</h1>
                <p class="operational_robot">Somnox sleep robot is now available in the world famous Harrods flagship store in London to help you succeed.</p>
                <a href="file:///Users/cemile/Desktop/VisualStudio%20code/work%20practise/CCI%20Technology/caseStudies.html" class="operational_link operational_btn">Case Studies</a>
            </div>
        </div>
    </div>
</div>
<div class="bottom-img ">
    <img class="img-fluid" src="{{asset('./frontend/img/bottom_wave_01.png')}}">
</div>
<div class="floating-img-bottom">
    <img class="img-fluid" src="{{asset('./frontend/img/floating_image_04.png')}}">
</div>
</section>
<!-- Future -->
<section class="future">
<div class="container">
    <div class="row future_top">
        <div class="col-lg-6 col-12">
            <div class="future-left">
                <h1 class="future-left_future">Future is brighter when you’re more prepared</h1>
                <p class="future-left_help">We help you weather today's uncertainty through our best team needs.</p>
                <a href="file:///Users/cemile/Desktop/VisualStudio%20code/work%20practise/CCI%20Technology/industries.html" class="fututre_link future_btn">Our Industries</a>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="row future-cards">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="future_developing">
                        <img class="img-fluid" src="{{asset('./frontend/img/global-services.svg')}}" width="80" height="80">
                        <p class="future_developing_text">Developing Financing Options</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="future_developing">
                        <img class="img-fluid" src="{{asset('./frontend/img/global-services.svg')}}" width="80" height="80">
                        <p class="future_developing_text">Financial Modeling and Analytics</p>
                    </div>
                </div>
            </div>
            <div class="row future-cards ">
                <div class="future_developing">
                    <img class="img-fluid" src="{{asset('./frontend/img/global-services.svg')}}" width="80" height="80">
                    <p class="future_developing_text">Improving Your Business Planning</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="future_developing">
                        <img class="img-fluid" src="{{asset('./frontend/img/global-services.svg')}}" width="80" height="80">
                        <p class="future_developing_text">Delivering Financing Solutions</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row future_bottom">
            <div class="col-lg-4 col-12">
                <div class="future_bottom_card">
                    <span class="future_01">01</span>
                    <h4 class="future_able">We are able to give truly independent advice</h4>
                    <p class="future_low">Capitalize on low hanging fruit to identify a ballpark value added.</p>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="future_bottom_card">
                    <span class="future_01">02</span>
                    <h4 class="future_able">Financial advice based on your goals</h4>
                    <p class="future_low">Override the digital divide with additional clickthroughs from DevOps.</p>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="future_bottom_card">
                    <span class="future_01">03</span>
                    <h4 class="future_able">We’re here to help during market volatility</h4>
                    <p class="future_low">Nanotechnology immersion along the information highway will close loop.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Create -->
<section class="create">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="create-img">
                <img class="img-fluid" src="{{asset('./frontend/img/fluid_hero_04.jpg')}}">
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="create-text">
                <h1 class="create-text_leads"> Create more leads and grow your business</h1>
                <h3 class="create-text_help">We can help you with picking out the best people for your company and its work.</h3>
                <p class="create-text_company">
                    Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps nanotechnology immersion.</p>
                <span class="card_bottom_text"><a class="innovation_link " href="#">READ MORE <i class="fas fa-arrow-circle-right innovation_icon innovation_icon-about"></i></a></span>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('js')
@endsection
