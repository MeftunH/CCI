<header>
    <!-- if seri qoyulacaq home  ucun -->
    <nav class="header_nav home-header">
        <div class="container">
            <div class="row header">
                <div class="col-lg-auto">
                    <div class="header_logo">
                        <img class="img-fluid home-logo logo_img" src="{{asset('./frontend/img/logo_white.png')}}" >
                    </div>
                </div>
                <div class="col-lg-7  d-lg-block d-md-flex">
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
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('about')}}">Our Story</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('case_studies')}}">Case Studies</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('academy')}}">Academy</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('industries')}}">Industries</a></li>
                                    <li class="dropdown_items"><a class="down_link down_link-home" href="{{route('services')}}">Services and Solutions</a></li>
                                </ul>
                            </li>
                            <li class="nav_items"><a class="nav_link" href="{{route('careers')}}">Vacancies</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('news')}}">News</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('events')}}">Events</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('connect')}}">Connect</a></li>
                            <li class="nav_items"><a class="nav_link" href="{{route('partners')}}">Partners</a></li>
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
