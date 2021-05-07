@if (request()->route()->getName() == 'index')
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
                                <div class="nav_items"><a class="nav_link active active-home" href="/index.html">Home</a></div>

                                <li class="open open-home nav_items"><a class="nav_links nav_open" href="#">About Us</a>
                                    <ul class="dropdown">
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/about.html">Our Story</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/academy.html">Academy</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/industries.html">Industries</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/services.html">Services and Solutions</a></li>
                                    </ul>
                                </li>
                                <li class="nav_items"><a class="nav_link" href="/careers.html">Vacancies</a></li>
                                <li class="nav_items"><a class="nav_link" href="/events.html">Events</a></li>
                                <li class="nav_items"><a class="nav_link" href="/connect.html">Connect</a></li>
                                <li class="nav_items"><a class="nav_link" href="/partners.html">Partners</a></li>
                                <li class="open open-home nav_items"><a class="nav_links nav_open" href="#">EN</a>
                                    <ul class="dropdown">
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/about.html">AZ</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/academy.html">RU</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="floating_img">
            <img class="img-fluid floating-img" src="{{asset('./frontend/img/floating_image.png')}}" width="680" height="58">
        </div>

    </header>
@else
    <header>

        <div class="container">
            <div class="row top_fixed">
                <div class="col-lg-6 d-lg-block d-none">
                    <div class="top_connection">
                        <a class="top_links" href="#"><i class="fas fa-envelope top-icon"></i> <span class="icon_text">info@bold-themes.com</span>
                        </a>
                        <a class="top_links" href="#"><i class="fas fa-map-marker-alt top-icon"></i> <span
                                class="icon_text">60 East 65th Street, New York</span></a>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none">
                    <div class="top_social">
                        <a class="top_link" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="top_link" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="top_link" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="header_nav">
            <div class="container">
                <div class="row header">
                    <div class="col-lg-auto">
                        <div class="header_logo">
                            <img class="img-fluid logo_img" src="{{asset('./frontend/img/logo_white (1).png')}}">
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
                                <div class="nav_items"><a class="nav_link active active-home" href="/index.html">Home</a></div>

                                <li class="open open-home nav_items"><a class="nav_links nav_open" href="#">About Us</a>
                                    <ul class="dropdown">
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/about.html">Our Story</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/academy.html">Academy</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/industries.html">Industries</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/services.html">Services and Solutions</a></li>
                                    </ul>
                                </li>
                                <li class="nav_items"><a class="nav_link" href="/careers.html">Vacancies</a></li>
                                <li class="nav_items"><a class="nav_link" href="/events.html">Events</a></li>
                                <li class="nav_items"><a class="nav_link" href="/connect.html">Connect</a></li>
                                <li class="nav_items"><a class="nav_link" href="/partners.html">Partners</a></li>
                                <li class="open open-home nav_items"><a class="nav_links nav_open" href="#">EN</a>
                                    <ul class="dropdown">
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/about.html">AZ</a></li>
                                        <li class="dropdown_items"><a class="down_link down_link-home" href="/academy.html">RU</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
@endif
