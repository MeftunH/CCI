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
    <section class="intro" style="background-image: url({{$about_us->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$about_us_translations->title}}</h1>
                        <p class="intro_work">{{$about_us_translations->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">

            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}">
        </div>
    </section>
    <!-- Long-Term -->
    <section>
        <div class="container">
            <div class="row long-term">
                <div class="col-lg-6 col-12">
                    <div class="long-term_left">
                        <div class="long_term-text">
                            <h1 class="long_term">{{$long_term_translations->title}}</h1>
                            <!-- <div class="texts"> -->

                            <p class="text">{{strip_tags($long_term_translations->description)}}</p>
                            <div class="long-term_list">
                                <ul class="long-term_items">
                                    @if(isset($long_term_item_translations))
                                        @foreach($long_term_item_translations as $lti_tr)
                                            <li class="long-terms_link">
                                                <i class="far fa-check-circle long-icon"></i>
                                                <span class="long-text">{{$lti_tr->title}}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="long-term_right">
                        <span class="line_lg"></span>
                        @foreach($time_line_translations->sort() as $k=>$v)
                        <div class="long-term-container">
                            <span class="term-circle">{{$k}}</span>
                            <div class="container-bottom">
                                @foreach($v as $translation)

                                <div @if($loop->last && $loop->parent->last) class="container-box last-box" @else class="container-box" @endif>
                                    <div class="box-title">
                                        <span class="card-month">{{\App\Helpers\LanguageHelper::DateTranslate($translation->date)}}</span>
                                    </div>
                                    <div class="box-tmain">
                                        <h3 class="card-office">{{$translation->title}}</h3>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

{{--                <div class="col-lg-6">--}}

{{--                    <div class="long-term_right">--}}

{{--                        <span class="line_lg"></span>--}}
{{--                        @foreach($time_line_translations->sort() as $k=>$v)--}}
{{--                            @if($loop->index == 0)--}}
{{--                                <div class="lg-circle">--}}
{{--                                    <div class="lg-circle_2016">--}}

{{--                                        <h3 class="lg-circle-number">{{$k}}</h3>--}}

{{--                                    </div>--}}
{{--                                    @elseif($loop->index == 1)--}}
{{--                                        <div class="lg-circle">--}}
{{--                                            <div class="lg-circle_2018">--}}
{{--                                                <h3 class="lg-circle-number">{{$k}}</h3>--}}
{{--                                            </div>--}}
{{--                                            @else--}}
{{--                                                <div class="lg-circle">--}}
{{--                                                    <div class="lg-circle_2019">--}}
{{--                                                        <h3 class="lg-circle-number">{{$k}}</h3>--}}
{{--                                                    </div>--}}
{{--                                                    @endif--}}

{{--                                                </div>@foreach($v as $translation)--}}

{{--                                                    <div class="lg-cards_01">--}}
{{--                                                        <div class="lg-cards_card_01">--}}
{{--                                                            <span class="card-month">{{$translation->date}}</span>--}}
{{--                                                            <h3 class="card-office">{{$translation->title}}</h3>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                                @endforeach--}}
{{--                                        </div>--}}

{{--                                </div>--}}

{{--                    </div>--}}
{{--                </div>--}}

        </div>
        </div>
        {{--        if u have problem some css delete last 2 div  --}}
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
                        <h1 class="operational_process">{{$operational->localized_data->first()->title}}</h1>
                        <p class="operational_robot">{{$operational->localized_data->first()->description}}</p>
                        <a href="{{route('case_studies')}}"
                           class="operational_link operational_btn">{{trans('front.case_studies')}}</a>
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
                        <h1 class="future-left_future">{{$future->localized_data->first()->title}}</h1>
                        <p class="future-left_help">{{$future->localized_data->first()->description}}</p>
                        <a href="file:///Users/cemile/Desktop/VisualStudio%20code/work%20practise/CCI%20Technology/industries.html"
                           class="fututre_link future_btn">Our Industries</a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="row future-cards">
                        @foreach($future_items as $futureItem)
                            @foreach($futureItem->localized_data as $fi)
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="future_developing">
                                        <img class="img-fluid" src="{{$futureItem->image}}" width="80"
                                             height="80">
                                        <p class="future_developing_text">{{$fi->title}}</p>
                                    </div>
                                </div>

                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="row future_bottom">
                    @foreach($future_list_items as $futureItem)

                        <div class="col-lg-4 col-12">
                            @foreach($futureItem->localized_data as $fi)
                                <div class="future_bottom_card">
                                    <span class="future_01">0{{$loop->index+1}}</span>
                                    <h4 class="future_able">{{$fi->title}}</h4>
                                    <p class="future_low">{{$fi->description}}</p>
                                    @endforeach
                                </div>
                        </div>

                    @endforeach

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
                        <h3 class="create-text_help">We can help you with picking out the best people for your company
                            and its work.</h3>
                        <p class="create-text_company">
                            Capitalize on low hanging fruit to identify a ballpark value added activity to beta test.
                            Override the digital divide with additional clickthroughs from DevOps nanotechnology
                            immersion.</p>
                        <span class="card_bottom_text"><a class="innovation_link " href="#">READ MORE <i
                                    class="fas fa-arrow-circle-right innovation_icon innovation_icon-about"></i></a></span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
