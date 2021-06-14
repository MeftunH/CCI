@extends('layouts.front')
@section('title')
    Contact
@endsection
@section('css')
@endsection


@section('content')

    <section class="intro" style="background-image: url('./frontend/img/hero_contact.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">Contact</h1>
                        <p class="intro_work">Together we can create something all inspirational you need to build.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}" >
        </div>
    </section>
    <!-- Reach -->
    <section class="reach">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="reach-text">
                        <p class="reach-text_help">HOW CAN WE HELP YOU OUT?</p>
                        <h1 class="reach-text_out">Reach out to us in the nearest office.</h1>
                        <!-- <span class="reach-text_number">1-800-700-600</span> -->
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="reach-card">
                                <p class="reach-card_adress">Address</p>
                                <h3 class="reach-card_city">BAKU</h3>
                                <h4 class="reach-card_street">60 East 65th Street
                                    NY 10065</h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="reach-card">
                                <p class="reach-card_adress">Get In Touch</p>
                                <h3 class="reach-card_city">Working hours:</h3>
                                <h4 class="reach-card_street">Monday - Friday
                                    9 am to 7 pm EST</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->
                        <div class="col-lg-12">
                            <div class="reach-social">
                                <h2 class="reach-social_media">Social Media</h2>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="social">
                                <a class="social-link" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="social-link" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="social-link" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="row">

                    </div> -->
                </div>
                <div class="col-lg-6">
                    <div class="reach-form">
                        <div class="form-text">
                            <p>CONTACT US</p>
                            <h1 class="form_leave">Leave us a little info, and we'll be in touch.</h1>
                        </div>
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="name">Name (required)</label>
                                        <input id="name" name="user name" type="text" placeholder="Your name" required>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="email">Your Email (required)</label>
                                        <input id="email" name="user email" type="email" placeholder="Your email" required>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="subject">Subject (optional)</label>
                                        <input id="subject" name="user subject" type="text" placeholder="Your subject" required>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="details">Project details</label>
                                        <input id="details" name="user details" class="last-input" type="text" placeholder="Brief project details" required>
                                    </div>

                                </div>

                                <a href="#" class="form-btn form-link">Send a message</a>
                            </form>
                        </div>
                        <!-- <div class="form">

                        </div> -->
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    <!-- Map -->
    <section class="Map">
        <div class="container">
            <div class="row">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d24305.017247604497!2d49.822575!3d40.4060338!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2s!4v1622414329736!5m2!1str!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
@endsection
