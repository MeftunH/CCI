@extends('layouts.backend.master')

@section('title')
    Edit Intro
@endsection

@section('css')

@endsection
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">{{trans('back.edit_long_term')}}</h2>
                        </div>
                        <div class="col-6">
                        <a href="{{ url()->previous() }}" type="button"
                           class="btn btn-gradient-primary"> {{trans('back.back')}} </a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-12 grid-margin strecth  stretch-card">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">

                                        <div class="col-md-6 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <img id="preview-image-before-upload"
                                                         src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                         alt="preview image" class="img-fluid"
                                                         style="max-height: 100px;">
                                                </div>
                                                <div class="col-md-6 col-6">

                                                    <label>Old Image: </label>

                                                    <img src="{{$client->image}}" alt="{{$client->image}}"
                                                         class="img-fluid">
                                                    <input type="hidden" name="old_image" value="{{ $client->image }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                {{trans('back.status')}}
                                            @if($client->status == 1)
                                                    <span class="badge badge-success badge-pill"> {{trans('back.active')}} </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill"> {{trans('back.passive')}}  </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                {{trans('back.is_slide_content')}}
                                            @if($client->is_slide_content == 1)
                                                    <span class="badge badge-success badge-pill"> {{trans('back.yes')}} </span>
                                                @else
                                                    <span class="badge badge-danger badge-pill"> {{trans('back.no')}}  </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>

        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('./backend/assets/js/summernote-ext-addclass.js')}}"></script>

    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#image').change(function () {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
