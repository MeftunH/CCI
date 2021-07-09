<header>
    <!-- if seri qoyulacaq home  ucun -->
    <nav class="header_nav home-header">
        <div class="container">
            <div class="row header">
                <div class="col-lg-auto">
                    <div class="header_logo">
                        <img class="img-fluid home-logo logo_img" src="{{asset($settings->index_navbar_logo)}}" >
                    </div>
                </div>
                <div class="col-lg-9  d-lg-block d-md-flex">
                    <div class="navbar">
                        <div class="hamburger-menu d-lg-none d-flex">
                            <div class="line line-1"></div>
                            <div class="line line-2"></div>
                            <div class="line line-3"></div>
                        </div>
                        <ul class="navbar_items">
                            <div class="nav_items"><a class="nav_link active active-home" href="{{route('index')}}">{{trans('front.home')}}</a></div>

                            <li class="open open-home nav_items"><a class="nav_links nav_open" href="#">{{trans('front.about_us')}}</a>
                                <ul class="dropdown">
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('about')}}">{{trans('front.our_story')}}</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('case_studies')}}">{{trans('front.case_study')}}</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('academy')}}">{{trans('front.academy')}}</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('industries')}}">{{trans('front.industries')}}</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('services')}}">{{trans('front.services_and_solutions')}}</a></li>
                                </ul>
                            </li>
                            <li class="nav_items"><a class="nav_link" href="{{route('careers')}}">{{trans('front.vacancies')}}</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('news')}}">{{trans('front.news')}}</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('event')}}">{{trans('front.events')}}</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('connect')}}">{{trans('front.connect')}}</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('apply')}}">{{trans('front.apply')}}</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('partners')}}">{{trans('front.partners')}}</a></li>
                            @foreach($languages as $key=>$lang)
                                @if($lang->locale == app()->getLocale())
                                    <li class="open open-home nav_items"><a class="nav_links nav_open"
                                                                            href="#">{{$lang->code}}<img
                                                src="{{$lang->flag }}" class="img-fluid" style="width: 16px"></a>

                                        @endif
                                        @endforeach
                                        <ul class="dropdown">
                                            @foreach($languages as $key=>$lang)
                                                @if($lang->locale != app()->getLocale())
                                                    <li class="dropdown_items"><a class="down_link down_link-home"
                                                                                  href="{{LaravelLocalization::getLocalizedURL($lang->locale, null, [], true)}}">{{$lang->code }}
                                                            <img src="{{$lang->flag}}" class="img-fluid"
                                                                 style="width: 16px"></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="floating_img">
        <img class="img-fluid floating-img" src="{{asset('./frontend/img/floating_image.png')}}" width="680" height="58">
    </div>

</header>
<div class="floating_img">
    <img class="img-fluid floating-img" src="{{asset('./frontend/img/floating_image.png')}}" width="680" height="58">
</div>
