<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c0b38f19a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('frontend/index.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/media.css')}}">
    @yield('css')
    <title>@yield('title')</title>
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
<footer>
    <div class="container">
        <div class="row footer-subscribe">
            <div class="col-lg-6 col-12">
                <h1 class="subscribe-text">Subscribe to our Newsletter</h1>
            </div>
            <div class="col-lg-3 col-6">
                <input class="email" type="email" placeholder="Your email">
            </div>
            <div class="col-lg-3 col-6">
                <a href="#" class="subscribe">Subscribe</a>
            </div>
        </div>
        <div class="row footer">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <div class="footer_logo">

                        <img src="{{asset('./frontend/img/footer_logo.png')}}" class="img-fluid" >
                        <div class="footer_connection">
                            <a class="footer_links" href="#"><i class="fas fa-envelope footer-icon"></i> <span class="icon_text">info@bold-themes.com</span>
                            </a>
                            <a class="footer_links" href="#"><i class="fas fa-map-marker-alt footer-icon"></i> <span class="icon_text">60 East 65th Street, New York</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <li class="footer-link">Site map</li>
                    <a class="footer_link" href="#">Academy</a>
                    <a class="footer_link" href="#">Events</a>
                    <a class="footer_link" href="#">News</a>
                    <a class="footer_link" href="#">Industries</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="footer_services">
                    <li class="footer-link">Connect</li>
                    <div class="social">
                        <a class="social_link" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="social_link" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="social_link" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="footer_text">
                        We bring the years, global experience, and stamina to guide our clients through new and often disruptive realities.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row footer-black">
            <div class="col-lg-6 col-12">
                <div class="footer-black_right">
                    <p class="copy-line">©2020 NIFTY. All rights reserved</p>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="footer-black_left">
                    <a class="footer-black_link" href="#">Privacy Policy</a>
                    <a class="footer-black_link" href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
@yield('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('frontend/news.js')}}"></script>

</body>
</html>
