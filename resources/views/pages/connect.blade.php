@extends('layouts.front')
@section('title')
    Contact
@endsection
@section('css')
@endsection
@include('sweetalert::alert')
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@include('alert::bootstrap')

@section('content')

    <section class="intro" style="background-image: url({{$intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{!! $intro->title !!}</h1>
                        <p class="intro_work">{!! $intro->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_White_bottom_right_shape_03.png')}}">
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
                                <p class="reach-card_adress">{{trans('front.address')}}</p>
                                <h4 class="reach-card_street">{!! $module->address  !!}</h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="reach-card">
                                <p class="reach-card_adress">{{trans('front.get_in_touch')}}</p>
                                <h4 class="reach-card_street">{!! $module->working_hours !!}</h4>
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
                            <form method="post" action="contact-us">
                                {{csrf_field()}}
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="name">Name (required)</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               value="{{old('name')}}"
                                               placeholder="Your Name" name="name" id="name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="email">Your Email (required)</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Email" name="email" id="email" value="{{old('email')}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="subject">Subject (optional)</label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                               placeholder="Subject" name="subject" id="subject"
                                               value="{{old('subject')}}">
                                        @error('subject')
                                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label for="details">Project details</label>
                                        <input id="details" @error('message') is-invalid @enderror name="message"
                                               class="last-input" type="text" value="{{old('value')}}"
                                               placeholder="Brief project details">
                                    </div>

                                </div>

                                <button type="submit" id="contactbtn" class="form-btn form-link"
                                        onclick="successIconMarkup()">Send a message
                                </button>

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
                    {!! $module->map !!}
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
    @if(Session::has('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{trans('mail.sent')}}',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
        @elseif(Session::has('error'))
        <script>Swal.fire({
                title: 'Error!',
                text: '{{trans('mail.error')}}',
                icon: 'error',
                confirmButtonText: 'Cool'
            })</script>
    @endif
 @endsection
