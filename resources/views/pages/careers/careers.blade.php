@extends('layouts.front')
@section('title')
    Careers
@endsection
@section('css')
@endsection
@section('navbar')
    @include('layouts.navbar.non_index_navbar')
@stop
@section('content')

    <!-- Intro -->
    <section class="intro" style="background-image: url({{$career->background_image}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="intro_text">
                        <h1 class="intro_about">{{$career->title}}</h1>
                        <p class="intro_work">{{$career->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom_img">
            <img class="img-fluid" src="{{asset('/frontend/img/bottom_wave_02_gray (1).png')}}">
        </div>
    </section>
    <!-- Career Consulting -->
    <section class="career" style="background-image: url('/frontend/img/background_dots_01.png');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="long-term_left">
                        <div class="long_term-text">
                            <h1 class="long_term">{{$career_consulting->title}}</h1>

                            <!-- <div class="texts"> -->
                            <p class="text">{!! $career_consulting->description !!}</p>
                            <!-- </div> -->
                        </div>
                        <div class="long-term_list">
                            <ul class="long-term_items">
                                @foreach($career_consulting_items as $cci)
                                    <li class="long-terms_link">
                                        <i class="far fa-check-circle long-icon"></i>
                                        <span class="long-text">{!! $cci->title !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    @foreach($cc_cards as $cc)
                        @switch($loop->index)
                            @case(0)
                            <div class="row careers-cards">

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="careers-card card-top-01">
                                        <div class="card-top">
                                            <div class="careers-img-01" style="background-image: url({{$cc->image}});">
                                            </div>
                                        </div>
                                        <div class="experience-bottom">
                                            <h3>{{$cc->title}}</h3>
                                            <span class="card_bottom_text"><a class="innovation_link"
                                                                              href="{{route('career.read_more',$cc->cc_card_id)}}">{{trans('back.read_more')}} <i
                                                        class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                @break
                                @case(1)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="careers-card card-top-02">
                                        <div class="card-top">
                                            <div class="careers-img-01" style="background-image: url({{$cc->image}});">
                                            </div>
                                        </div>
                                        <div class="experience-bottom">
                                            <h3>{{$cc->title}}</h3>
                                            <span class="card_bottom_text"><a class="innovation_link"
                                                                              href="{{route('career.read_more',$cc->cc_card_id)}}">{{trans('back.read_more')}} <i
                                                        class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                @break
                            </div>

                            <div class="row careers-cards">
                                @case(2)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="careers-card card-top-03">
                                        <div class="card-top">
                                            <div class="careers-img-01" style="background-image: url({{$cc->image}});">
                                            </div>
                                        </div>
                                        <div class="experience-bottom">
                                            <h3>{{$cc->title}}</h3>
                                            <span class="card_bottom_text"><a class="innovation_link"
                                                                              href="{{route('career.read_more',$cc->cc_card_id)}}">{{trans('back.read_more')}} <i
                                                        class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                @break
                                @case(3)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="careers-card card-top-04">
                                        <div class="card-top">
                                            <div class="careers-img-01" style="background-image: url({{$cc->image}});">
                                            </div>
                                        </div>
                                        <div class="experience-bottom">
                                            <h3>{{$cc->title}}</h3>
                                            <span class="card_bottom_text"><a class="innovation_link"
                                                                              href="{{route('career.read_more',$cc->cc_card_id)}}">{{trans('back.read_more')}} <i
                                                        class="fas fa-arrow-circle-right innovation_icon"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                @break
                            </div>
                        @endswitch
                    @endforeach
                </div>
            </div>

        </div>
        <div class="bottom-img">
            <img class="img-fluid" src="{{asset('./frontend/img/white_bottom_wave_01.png')}}">
        </div>
    </section>
    <!-- Upload CV -->
    <section class="upload">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="upload-left">
                        <img class="img-fluid" src="{{asset($resume_up->image)}}">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="upload-right">
                        <div class="upload-text">
                            <h1 class="text-work">{{$resume_up_translations->title}}</h1>
                            <div class="best">
                                <span class="upload-best">{!! $resume_up_translations->description !!}</span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <form class="form-carrers" id="resume_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="label-careers" for="cv">{{$resume_up_translations->footer}}</label>
                                <div class="form-send">
                                    <input onchange="doAfterSelectImage(this)" class="input-careers" id="cv" name="cv"
                                           type="file" accept=".pdf,.doc">
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="wave-bottom">
            <img class="img-fluid" src="{{asset('./frontend/img/Wave_grey_bottom_left_shape_01 (1).png')}}">
        </div>
    </section>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function doAfterSelectImage(input) {
            uploadCv();
        }

        function uploadCv() {

            let cvForm = document.getElementById('resume_form');
            let formData = new FormData(cvForm);
            let size = $("#cv")[0].files[0].size;
            console.log(size);
            if (size < 2000000) {
                Swal.fire({
                    title: '{{trans('front.u_want_save')}}',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: '{{trans('front.save')}}',
                    denyButtonText: '{{trans('front.dont_save')}}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            url: '{{route('career.upload_cv')}}',
                            success: function (response) {
                                if (response == 200) {
                                    setTimeout(() => {
                                        $('#notifDiv').fadeOut();
                                    }, 3000);
                                    Swal.fire('{{trans('front.saved')}}', '', 'success')
                                } else if (response == 700) {
                                    setTimeout(() => {
                                        $('#notifDiv').fadeOut();
                                    }, 3000);
                                    console.log('fail');
                                }
                            }.bind($(this))
                        });

                    } else if (result.isDenied) {
                        Swal.fire('{{trans('front.are_not_saved')}}', '', 'info')
                    }
                    document.getElementById('resume_form').reset();
                })
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: '{{trans('front.file_max_size_error')}}',
                    text: '{{trans('front.max_file_size_is_2MB')}}',
                })
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        }
    </script>
@endsection
