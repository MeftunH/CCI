@extends('layouts.front')
@section('title')
    Contact
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop

@section('content')
    <section class="intro" style="background-image: url({{$intro->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{!! $intro->title !!}</h1>
                        <p class="intro_work">Together we can create something all inspirational you need to build.</p>
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

                <div class="col-lg-12">
                    <div class="reach-form">
                        <div class="form-text">
                            <h1 class="form_leave">Apply</h1>
                        </div>
                        <div class="row">
                            <form method="post" action="apply-mail">
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
                                        <label for="surname">Surname (required)</label>
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                               value="{{old('surname')}}"
                                               placeholder="Your Name" name="surname" id="surname">
                                        @error('surname')
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
                                        <label for="phone_number">Telephone Number (optional)</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                               placeholder="phone number" name="phone_number" id="phone_number" value="{{old('phone_number')}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                                        @enderror
                                    </div>

                                </div>


                                <button type="submit" id="applybtn" class="form-btn form-link"
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
    </section>

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
