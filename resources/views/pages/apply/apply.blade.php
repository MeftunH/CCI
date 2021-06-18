@extends('layouts.front')
@section('title')
    Contact
@endsection
@section('css')
@endsection


@section('content')
    <section class="intro" style="background-image: url('./img/hero_contact.jpg');">
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
            <img class="img-fluid" src="./img/Wave_White_bottom_right_shape_03.png" >
        </div>
    </section>
    <!-- Reach -->
    <section class="reach">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="reach-form">
                        <div class="form-text">

                            <h1 class="form_leave">Apply</h1>
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
                                        <label for="name">Surname (required)</label>
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
                                        <label for="subject">Telephone Number (optional)</label>
                                        <input id="subject" name="user subject" type="text" placeholder="Your subject" required>
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
    </section>

@endsection
@section('js')
@endsection
