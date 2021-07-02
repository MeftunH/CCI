@extends('layouts.backend.master')

@section('title')
    {{trans('show_settings')}}
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
                            <h2 class="content-header-title float-left mb-0"> {{trans('show_settings')}}</h2>
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

                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.admin_panel_logo_old_image')}}</label>

                                                <img name="admin_panel_logo_old_image" src="{{$settings->admin_panel_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->admin_panel_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.admin_panel_icon_old_image')}}</label>

                                                <img name="admin_panel_icon_old_image" src="{{$settings->admin_panel_icon}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->admin_panel_icon}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.index_footer_old_logo_upload')}}</label>

                                                <img name="index_footer_old_logo_upload" src="{{$settings->index_footer_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->index_footer_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">

                                            <div class="col">

                                                <label>{{trans('settings.non_index_footer_logo_upload_old_image')}}</label>

                                                <img name="non_index_footer_logo_upload_old_image" src="{{$settings->non_index_footer_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->non_index_footer_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.index_navbar_logo_upload_old_image')}}</label>

                                                <img name="index_navbar_logo_upload_old_image" src="{{$settings->index_navbar_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->index_navbar_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.non_index_navbar_logo_old_image')}}</label>

                                                <img name="non_index_navbar_logo_old_image" src="{{$settings->non_index_navbar_logo}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->non_index_navbar_logo}}">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col">

                                                <label>{{trans('settings.frontend_icon_upload_old_image')}}</label>

                                                <img name="frontend_icon_upload_old_image" src="{{$settings->frontend_icon}}"
                                                     class="img-fluid"
                                                     style="width: 150px" alt="{{$settings->frontend_icon}}">
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <label>{{trans('settings.mail')}} </label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           name="mail"
                                           value="{{ $settings->mail }}" disabled>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('./backend/assets/js/summernote-bs4.min.js')}}"></script>

@endsection
