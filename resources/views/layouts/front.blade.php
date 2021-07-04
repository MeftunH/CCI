<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c0b38f19a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('frontend/index.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/media.css')}}">
    <link rel="icon" href="{{$settings->frontend_icon}}">
    <link rel="shortcut icon" href="{{$settings->frontend_icon}}">

    @yield('css')
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<!-- Header -->
<header>
    @yield('navbar')


</header>
<!-- Main -->
<main>
    @yield('content')
</main>
<!-- Footer -->
@if(Route::is('index') )
<footer>
    <div class="container">
        <div class="row footer-subscribe">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-7 col-12">
                <h1 class="subscribe-text">{{trans('front.subscribe_our_newsletter')}}</h1>
            </div>


            <div class="col-lg-5 col-12">
                <form method="POST" action="{{route('subscriber.store')}}">

                    {{csrf_field()}}
                    <input class="email" type="email" name="email" placeholder="{{trans('front.your_email')}}">
                    <button type="submit" class="subscribe">{{trans('front.subscribe_btn')}}</button>
                </form>
            </div>

        </div>

        <div class="row footer">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <div class="footer_logo">

                        <img src="{{asset($settings->index_footer_logo)}}" class="img-fluid">
                        <div class="footer_connection">
                            <a class="footer_links" href="mailto:{{$settings->mail}}"><i class="fas fa-envelope footer-icon"></i> <span
                                    class="icon_text">{{$settings->mail}}</span>
                            </a>
                            <a class="footer_links" href="https://maps.google.com/maps?q={{trans('footer.footer_mini_address')}}"><i class="fas fa-map-marker-alt footer-icon"></i> <span
                                    class="icon_text">{{trans('front.footer_mini_address')}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <li class="footer-link">{{trans('front.sitemap')}}</li>
                    <a class="footer_link" href="{{route('academy')}}">{{trans('front.academy')}}</a>
                    <a class="footer_link" href="{{route('event')}}">{{trans('front.events')}}</a>
                    <a class="footer_link" href="{{route('news')}}">{{trans('front.news')}}</a>
                    <a class="footer_link" href="{{route('industries')}}">{{trans('front.industries')}}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <li class="footer-link">{{trans('front.connect')}}</li>
                    <div class="social">

                        <a class="social_link" href="{{$socials->first()->link}}"><i class="fab fa-facebook-f"></i></a>
                        <a class="social_link" href="{{$socials->skip(1)->first()->link}}"><i class="fab fa-instagram"></i></a>
                        <a class="social_link" href="{{$socials->skip(2)->first()->link}}"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="footer_text">
                        {{trans('front.footer_social_text')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row footer-black">
            <div class="col-lg-6 col-12">
                <div class="footer-black_right">
                    <p class="copy-line">{{trans('front.all_rights_reserved')}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="footer-black_left">
                    <a class="footer-black_link" href="#">{{trans('front.privact_policy')}}</a>
                    <a class="footer-black_link" href="#">{{trans('front.cookie_policy')}}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
@else
    <footer>
        <div class="container">
            <div class="row footer-subscribe">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-7 col-12">
                    <h1 class="subscribe-text">{{trans('front.subscribe_our_newsletter')}}</h1>
                </div>


                <div class="col-lg-5 col-12">
                    <form method="POST" action="{{route('subscriber.store')}}">

                        {{csrf_field()}}
                        <input class="email" type="email" name="email" placeholder="{{trans('front.your_email')}}">
                        <button type="submit" class="subscribe">{{trans('front.subscribe_btn')}}</button>
                    </form>
                </div>

            </div>

            <div class="row footer">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="footer_services">
                        <div class="footer_logo">

                            <img src="{{asset($settings->non_index_footer_logo)}}" class="img-fluid">
                            <div class="footer_connection">
                                <a class="footer_links" href="mailto:{{$settings->mail}}"><i class="fas fa-envelope footer-icon"></i> <span
                                        class="icon_text">{{$settings->mail}}</span>
                                </a>
                                <a class="footer_links" href="https://maps.google.com/maps?q={{trans('footer.footer_mini_address')}}"><i class="fas fa-map-marker-alt footer-icon"></i> <span
                                        class="icon_text">{{trans('front.footer_mini_address')}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="footer_services">
                        <li class="footer-link">{{trans('front.sitemap')}}</li>
                        <a class="footer_link" href="{{route('academy')}}">{{trans('front.academy')}}</a>
                        <a class="footer_link" href="{{route('event')}}">{{trans('front.events')}}</a>
                        <a class="footer_link" href="{{route('news')}}">{{trans('front.news')}}</a>
                        <a class="footer_link" href="{{route('industries')}}">{{trans('front.industries')}}</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="footer_services">
                        <li class="footer-link">{{trans('front.connect')}}</li>
                        <div class="social">

                            <a class="social_link" href="{{$socials->first()->link}}"><i class="fab fa-facebook-f"></i></a>
                            <a class="social_link" href="{{$socials->skip(1)->first()->link}}"><i class="fab fa-instagram"></i></a>
                            <a class="social_link" href="{{$socials->skip(2)->first()->link}}"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="footer_text">
                            {{trans('front.footer_social_text')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row footer-black">
                <div class="col-lg-6 col-12">
                    <div class="footer-black_right">
                        <p class="copy-line">{{trans('front.all_rights_reserved')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="footer-black_left">
                        <a class="footer-black_link" href="#">{{trans('front.privact_policy')}}</a>
                        <a class="footer-black_link" href="#">{{trans('front.cookie_policy')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif
@yield('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('frontend/news.js')}}"></script>
{!! Toastr::message() !!}
</body>
</html>
