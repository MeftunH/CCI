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
                            <h2 class="content-header-title float-left mb-0">{{trans('back.show_partner')}}</h2>
                        </div>
                        <div class="col-6">
                            <a href="{{ url()->previous() }}" type="button"
                               class="btn btn-gradient-primary"> {{trans('back.back')}} </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 grid-margin strecth  stretch-card">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-12">
                                <div class="tab-content" id="pills-tabContent">


                                    <label>Title </label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           name="title" readonly
                                           value="{{ $partner->title }}">
                                    <br>

                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="col-md-6 mb-2">

                                        <label>Image: </label>

                                        <img src="{{$partner->image}}" alt="{{$partner->image}}"
                                             class="img-fluid">
                                        <input type="hidden" name="old_image" value="{{ $partner->image }}">
                                    </div>
                                </div>
                            </div>
                            <label>{{trans('back.status')}}</label>
                            <label>
                                @if($partner->status == 1) <span
                                    class="badge badge-light-success"> {{trans('back.active')}} </span>
                                @else<span
                                    class="badge badge-light-danger"> {{trans('back.passive')}} </span>@endif

                            </label>
                        </div>
                        <br>
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
